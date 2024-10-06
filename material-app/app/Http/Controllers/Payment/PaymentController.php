<?php

namespace App\Http\Controllers\Payment;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class PaymentController extends Controller
{
    public function list(){
        return view('payments.list');
    }

    // Page Add New Data
    public function new(){
        return view('payments.new');
    }

    // Save New Data
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'payer' => 'required',
            'amount' => 'required',
            'nota' => 'max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        $id_payment = Uuid::uuid4();

        // Save Image To Storage
        $images = $request->file('nota');
        $filename = $images->hashName();
        $images->move(storage_path('app/public/assets/payment'), $filename);

        # Data pengiriman
        $delivery = new Payment();
        $delivery->id = $id_payment;
        $delivery->payment_date = $request->tanggal;
        $delivery->payer = $request->payer;
        $delivery->amount = $request->amount;
        $delivery->nota = $filename;
        $delivery->note = $request->note;
        $delivery->save();

        return ResponseFormatter::success(null, 'data has been stored');
    }

    // Page Edit Data
    public function edit($bid){
        $data = Payment::where('id', $bid)->firstorFail();
        return view('payments.edit', compact('data'));
    }

    // Save Updated Data
    public function update($bid, Request $request){
        // Main table
        Payment::where('id', $bid)->update([
            'payment_date' => $request->tanggal,
            'payer' => $request->payer,
            'amount' => $request->amount,
            'note' => $request->note
        ]);


        //Delete Removed Nota
        if( $request->remove_nota ){
            $nota = Payment::where('id', $request->remove_nota)->first();
            Storage::disk('public')->delete('assets/payment/'.$nota->nota);
        }

        // Update With Image
        if ($request->hasFile('nota')) {
                $images = $request->file('nota');
                $filename = $images->hashName();
                $images->move(storage_path('app/public/assets/payment'), $filename);

                Payment::where('id', $bid)->update([
                    'payment_date' => $request->tanggal,
                    'payer' => $request->payer,
                    'amount' => $request->amount,
                    'nota' => $filename,
                    'note' => $request->note
                ]);
        }
        return ResponseFormatter::success(null, 'data has been updated');
    }

    public function destroy(Request $request){
    }
}
