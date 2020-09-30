<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produk;
use App\Http\Resources\ProdukResource;

class ProdukController extends Controller
{
    //
    public function get_produk_kategori(Request $request){
        $kd_kategori = $request->input('kd_kategori');
        $produk= Produk::where([
            ['kd_kategori',$kd_kategori],
            ['stock','>',0]
        ])->get();
        if ($produk->isEmpty()) {
            # code...
            return response()->json([
                'status'=>FALSE,
                'msg'=>'Produk tidak ada'
            ], 200);
        }
        return ProdukResource::collection($produk);
    }
}
