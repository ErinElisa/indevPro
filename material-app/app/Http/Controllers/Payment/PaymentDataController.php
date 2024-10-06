<?php

namespace App\Http\Controllers\Payment;


use App\Http\Controllers\Controller;
use App\Models\Payment;
use Carbon\Carbon;
use DataTables;

class PaymentDataController extends Controller
{
    public function dt() {
        $data = Payment::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()->addColumn('action', function($row){
                $btn = '<div class="d-flex gap-2 justify-content-end">';
                $btn .= '<a href="javascript:void(0)" class="btn-remove btn btn-outline-danger btn-sm rounded-0 px-4" data-id="'.$row->id.'" onclick="remove(this)"><i class="material-icons-two-tone text-danger">delete</i> Hapus</a>';
                $btn .= '<a href="'.route('payment.edit', ['bid'=>$row->id]).'" class="btn btn-outline-primary btn-sm rounded-0 px-4"><i class="material-icons-two-tone text-primary">edit</i> Edit</a>';
                $btn .= '</div>';
                return $btn;
            })
            ->addColumn('date', function($row) {
                return '<span data-sort="'.$row->payment_date.'">'.Carbon::parse($row->payment_date)->format('d M Y').'</span>';
            })
            ->addColumn('payer', function($row){
                return $row->payer;
            })
            ->addColumn('amount', function($row){
                return rupiah_split($row->amount);
            })
            ->addColumn('nota', function($row){
                return '<a href="../storage/assets/payment/'.$row->nota.'" target="new">Lihat Nota</a>';
            })
            ->addColumn('note', function($row){
                return $row->note;
            })
            ->rawColumns(['date', 'payer', 'amount', 'nota', 'note', 'action']) // Remove 'action' if not using it
            ->make(true);
    }

}
