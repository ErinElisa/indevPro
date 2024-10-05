<?php

namespace App\Http\Controllers\Delivery;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\DataTables;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;


class DeliveryController extends Controller
{
    public function list(){
        return view('deliveries.list');
    }

    // Page Add New Data
    public function new(){
        $products = Product::orderBy('name')->get();
        return view('deliveries.new', compact('products'));
    }

    // Save New Data
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'product' => 'required',
            'sender' => 'required',
            'destination' => 'required',
            'qty' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        $id_delivery = Uuid::uuid4();


        # Data pengiriman
        $delivery = new Delivery();
        $delivery->id = $id_delivery;
        $delivery->delivery_date = $request->tanggal;
        $delivery->product = $request->product;
        $delivery->sender = $request->sender;
        $delivery->destination = $request->destination;
        $delivery->qty = $request->qty;
        $delivery->note = $request->note;
        $delivery->save();

        return ResponseFormatter::success(null, 'data has been stored');
    }

    // Page Edit Data
    public function edit($did){
        $data = Delivery::where('id', $did)->firstOrFail();
        $products = Product::orderBy('name')->get();

        return view('deliveries.edit', compact('data', 'products'));
    }

    // Save Updated Data
    public function update($did, Request $request){
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'product' => 'required',
            'sender' => 'required',
            'destination' => 'required',
            'qty' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 401,
                'errors' => $validator->errors()
            ]);
        }

        $id_delivery = Uuid::uuid4();

        # Data pengiriman
        Delivery::where('id', $did)->update([
            'delivery_date' => $request->tanggal,
            'product' => $request->product,
            'sender' => $request->sender,
            'destination' => $request->destination,
            'qty' => $request->qty,
            'note' => $request->note,
        ]);

        return ResponseFormatter::success(null, 'data has been updated');
    }

    public function destroy(Request $request){
        $validator = Validator::make($request->all(), [
            'did' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error($validator->errors(), 'error');
        }

        Delivery::where('id', $request->did)->delete();

        return ResponseFormatter::success(null, 'data has been deleted');
    }
}
