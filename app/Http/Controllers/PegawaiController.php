<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use Validator;
use Illuminate\Support\Arr;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        //
        $pegawai =Pegawai::paginate(5);
        $filterKeyword = $request->get('keyword');
        if ($filterKeyword) {
            # code...
            $pegawai = pegawai::where('nama_pegawai','LIKE',"%$filterKeyword%")->paginate(5);
        }
        return view('pegawai.index',compact('pegawai'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pegawai.create');
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
        $data=$request->all();
        $validasi = Validator::make($data,[
            'username'=>'required|max:100|unique:pegawai',
            'password'=>'required|min:6|max:50',
            'nama_pegawai' =>'required|max:255',
            'alamat'=>'required|max:255'
        ]);
        if ($validasi->fails()) {
            # code...
            return redirect()->route('pegawai.create')->withErrors($validasi)->withInput();
        }
        $data['password']=password_hash($request->input('password'),PASSWORD_DEFAULT);

        Pegawai::create($data);
        return redirect()->route('pegawai.index')->with('status','pegawai berhasil ditambah');
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $pegawai = Pegawai::findOrfail($id);
        // return view('pegawai.show',compact('pegawai'));
        
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
        $pegawai = Pegawai::findOrfail($id);
        return view('pegawai.edit',compact('pegawai'));
    
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
        $pegawai = Pegawai::findOrfail($id);
        $data = $request->all();

        $validasi = Validator::make($data,[
            'nama_pegawai' =>'required|max:255',
            'password'=>'sometimes|nullable|max:50',
            'alamat'=>'required|max:255'
        ]);
        if ($validasi->fails()) {
            # code...
            return redirect()->route('pegawai.edit')->withErrors($validasi);
        }
        if ($request->input('password')) {
            # code...
            $data['password']=password_hash($request->input('password'),PASSWORD_DEFAULT);
        }else{
            $data=Arr::except($data['pasword']);
        }
        $pegawai->update($data);
        return redirect()->route('pegawai.index')->with('status','pegawai berhasil diUpdate');
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
        $data= pegawai::findOrfail($id);
        $data->delete();
        return redirect()->route('pegawai.index')->with('status','pegawai berhasil dihapus');
    }
}
