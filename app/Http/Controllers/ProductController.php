<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function datarapbs(ProductDataTable $productdataTable)
    {
        return $productdataTable->render('dataproduct');
    }

    public function add()
    {
        return view('addMore');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $rules = [ 
            "name" => "required",
            "jabatan" => "required",
            "stocks.*" => "required" 
        ];
    
        foreach($request->stocks as $key => $value) {
            $rules["stocks.{$key}.quantity"] = 'required';
            $rules["stocks.{$key}.price"] = 'required';
        }

        // Custom error messages
        $messages = [
        "name.required" => "Nama Lengkap Wajib diisi.",
        "jabatan.required" => "Jabatan Wajib diisi.",
        "stocks.*.required" => "Semua stok harus diisi.",
        "stocks.*.quantity.required" => "Nama Kegiatan/Barang wajib diisi.",
        "stocks.*.price.required" => "Alokasi Anggaran wajib diisi.",
    ];

        $request->validate($rules, $messages);

        $product = Product::create([
            "name" => $request->name,
            "jabatan" => $request->jabatan]);

        foreach($request->stocks as $key => $value) {
            $product->stocks()->create($value);
        }

        return redirect()->back()->with(['success' => 'Pengajuan Berhasil disubmit.']);
    }
}
