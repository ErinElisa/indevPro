<?php

namespace App\Http\Controllers\Delivery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Carbon\Carbon;
use DataTables;

class DeliveryDataController extends Controller
{
    public function dt(){
        $data = Delivery::latest()->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<div class="d-flex gap-2 justify-content-end">';
                    $btn .= '<a href="javascript:void(0)" class="btn-remove btn btn-outline-danger btn-sm rounded-0 px-4" data-id="'.$row->id.'" onclick="remove(this)"><i class="material-icons-two-tone text-danger">delete</i> Hapus</a>';
                    $btn .= '<a href="'.route('delivery.edit', ['did'=>$row->id]).'" class="btn btn-outline-primary btn-sm rounded-0 px-4"><i class="material-icons-two-tone text-primary">edit</i> Edit</a>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->addColumn('date', function($row){
                    return '<span data-sort="'.$row->delivery_date.'">'.Carbon::parse($row->delivery_date)->format('d M Y').'</span>';
                })
                ->addColumn('product', function($row){
                    return $row->products->name;
                })
                ->addColumn('sender', function($row){
                    return $row->sender;
                })
                ->addColumn('destination', function($row){
                    return $row->destination;
                })
                ->addColumn('qty', function($row){
                    return $row->qty." Rit";
                })
                ->addColumn('note', function($row){
                    return $row->note;
                })
                ->rawColumns(['date', 'product', 'sender', 'destination', 'qty', 'note', 'action'])
                ->make(true);
    }
}
