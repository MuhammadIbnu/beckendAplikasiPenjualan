<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use App\Produk;
use Validator;
use Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $produk = Produk::paginate(5);
        $kategori = Kategori::all();
        $filterKeyword=$request->get('keyword');
        $nama_kategori='';
        if ($filterKeyword) {
            # code...
            $produk = Produk::where('nama_produk','LIKE',"%$filterKeyword%")->paginate(5);
        }
        $filter_by_kategori = $request->get('kd_kategori');
            if ($filter_by_kategori) {
                # code...
                $produk=Produk::where('kd_kategori',$filter_by_kategori)->paginate(5);
            $data_kategori=Kategori::find($filter_by_kategori);
            $nama_kategori=$data_kategori->kategori;
            }
            
        
        return view("produk.index",compact('produk','kategori'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $kategori = Kategori::all();
        return view('produk.create',compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $validasi= Validator::make($data,[
            'nama_produk'=>'required|max:255',
            'kd_kategori'=>'required',
            'harga'=>'required|numeric',
            'gambar_produk'=>'required|image|mimes:jpeg,jpg,png|max:2048'

        ]);
        if ($validasi->fails()) {
            # code...
            return redirect()->route('produk.create')->withErrors($validasi)->withInput();

        }
        

        if ($request->file('gambar_produk')->isValid()) {
            # code...
            $gambar_produk = $request->file('gambar_produk');
            $extention = $gambar_produk->getClientOriginalExtension();
            $namaFoto = "produk/".date('YmdHis').".".$extention;
            $upload_path='public/uploads/produk';
            $request->file('gambar_produk')->move($upload_path,$namaFoto);
            $data['gambar_produk']=$namaFoto;
        }
        $data['stock']= 0;
        Produk::create($data);
        return redirect()->route('produk.index')->with('status','produk berhasil di tambahakan');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $kategori = Kategori::all();
        $produk = Produk::findOrfail($id);
        return view('produk.edit',compact('kategori','produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $produk = Produk::findOrfail($id);
        $data = $request->all();

        $validasi = Validator::make($data,[
            'nama_produk'=>'required|max:255',
            'kd_kategori'=>'required',
            'harga'=>'required|numeric',
            'gambar_produk'=>'sometimes|required|image|mimes:jpeg,jpg,png|max:2048'

        ]);
        if ($validasi->fails()) {
            # code...
            return redirect()->route('produk.edit',[$id])->withErrors($validasi);
        }
        if ($request->hasfile('gambar_produk')) {
            # code...
            if ($request->file('gambar_produk')->isValid()) {
                # code...
                Storage::disk('upload')->delete($produk->gambar_produk);
               
                $gambar_produk = $request->file('gambar_produk');
                $extention = $gambar_produk->getClientOriginalExtension();
        
                $namaFoto ="produk/".date('YmdHis').".".$extention;
                $upload_path='public/uploads/produk';
                $request->file('gambar_produk')->move($upload_path,$namaFoto);
                $data['gambar_produk'] = $namaFoto;
            }
        }
       
        $produk->update($data);
        return redirect()->route('produk.index')->with('status','data produk berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $kategori = Kategori::all();
        $produk = Produk::findOrfail($id);
        $produk->delete();
        Storage::disk('upload')->delete($produk->gambar_produk);
        return redirect()->route('produk.index')->with('status','produk telah dihapus');
    }
}
