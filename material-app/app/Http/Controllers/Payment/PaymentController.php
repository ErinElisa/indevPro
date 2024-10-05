<?php

namespace App\Http\Controllers\Payment;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function list(){
        return view('payments.list');
    }

    // Page Add New Data
    public function new(){
    }

    // Save New Data
    public function store(Request $request){
    }

    // Page Edit Data
    public function edit($did){
    }

    // Save Updated Data
    public function update($did, Request $request){
    }

    public function destroy(Request $request){
    }
}
