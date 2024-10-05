<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class ProductsController extends Controller
{
    // Page List Products
    public function list(){
        $products = Product::all();
        return view('products.list', compact('products'));
    }

    // Page Add New Data
    public function new(){
        return view('products.new');
    }

    // Save New Data
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'image' => 'max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        $id_product = Uuid::uuid4();

        // Save Image To Storage
        $images = $request->file('image');
        $filename = $images->hashName();
        $images->move(storage_path('app/public/assets/'), $filename);

        // Save Data To Database
        $product = new Product();
        $product->id = $id_product;
        $product->name = $request->name;
        $product->slug = str_replace(' ', '-', $request->name);
        $product->price = $request->price;
        $product->image = $filename;
        $product->save();

        return ResponseFormatter::success(null, 'data has been stored');
    }

    // Page Edit Data
    public function edit($eid){
        $data = Product::where('id', $eid)->firstorFail();

        return view('products.edit', compact('data'));
    }

    public function update($eid, Request $request){

        $data = Product::where('id', $eid)->firstOrFail();

        $slug = str_replace(' ', '-', $request->name);

        // Main table
        Product::where('id', $eid)->update([
            'name' => $request->name,
            'slug' => $slug,
            'price' => $request->price
        ]);

        // Update With Image
        if ($request->hasFile('image')) {
                $images = $request->file('image');
                $filename = $images->hashName();
                $images->move(storage_path('app/public/assets'), $filename);

                Product::where('id', $eid)->update([
                    'name' => $request->name,
                    'slug' => $slug,
                    'price' => $request->price,
                    'image' => $filename
                ]);
        }
        return ResponseFormatter::success(null, 'data has been updated');
    }

    public function destroy(Request $request){
        $validator = Validator::make($request->all(), [
            'eid' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error($validator->errors(), 'error');
        }

        // remove images
        $files = Product::where('id', $request->eid)->get();
        foreach ($files as $file) {
            $nota = Product::where('id', $file->id)->first();
            Storage::disk('public')->delete('assets/'.$nota->image);
            Product::where('image', $nota->image)->delete();
        }

        // remove main data
        Product::where('id', $request->eid)->forceDelete();

        return ResponseFormatter::success(null, 'data has been deleted');
    }
}
