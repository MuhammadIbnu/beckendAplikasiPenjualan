<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use Alert;
use App\Agen;
use App\Transaksi;
use App\TransaksiDetail;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Alert::success('Selamat Datang Diweb PejualanKu ', 'JudulKu');
        $produk = Produk::count();
        $agen = Agen::count();
        $transaksi = TransaksiDetail::sum('jumlah');
        $pendapatan = Transaksi::sum('total');

        $nama_produk = [];
        $jumlah_penjualan=[];

        $data_produk = Produk::all();
        foreach($data_produk as $row){
            $nama_produk[] = $row->nama_produk;

            $jumlah_transaksi = TransaksiDetail::where('kd_produk',$row->kd_produk)->sum('jumlah');
            $jumlah_penjualan[] = $jumlah_transaksi;
        }
        return view('home',compact('produk','agen','transaksi','pendapatan','nama_produk','jumlah_penjualan'));
    }
}
