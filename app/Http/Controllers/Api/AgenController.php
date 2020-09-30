<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AgenResource;
use Validator;
use Storage;
use App\Agen;

class AgenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return AgenResource::collection(Agen::all());
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
        $input = $request->all();

        $validasi= Validator::make($input,[
            'nama_toko'=>'required|max:255',
            'nama_pemilik'=>'required|max:255',
            'alamat'=>'required|max:255',
            'latitude'=>'required|max:255',
            'longitude'=>'required|max:255',
            'gambar_toko'=>'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($validasi->fails()) {
            # code...
            return response()->json([
                "status"=>FALSE,
                "msg"=>$validasi->errors()
            ],400);
           
        }
        if ($request->file('gambar_toko')->isValid()) {
            # code...
            $gambar_toko = $request->file('gambar_toko');
            $extention = $gambar_toko->getClientOriginalExtension();
            $namaFoto = "agen/".date('YmdHis').".".$extention;
            $upload_path='public/uploads/agen';
            $request->file('gambar_toko')->move($upload_path,$namaFoto);
            $input['gambar_toko']=$namaFoto;
        }
        if (Agen::create($input)) {
            # code...
            return response()->json([
                'status'=>True,
                'msg'=>'Agen berhasil disimpan'
            ],201);
        }
        else{
            return response()->json([
                'status'=>FALSE,
                'msg'=>'Agen gagal disimpan'
            ],200);
        }
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
        $agen = Agen::find($id);
        if (is_null($agen)) {
            # code...
            return response()->json(
                [
                    "status"=>FALSE,
                    "msg"=>'Record not found'
                ],404
            );
        }
        return new AgenResource($agen);
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
        $input = $request->all();
        $agen = Agen::find($id);
        if (is_null($agen)) {
            # code...
            return response()->json([
                "status"=>FALSE,
                "msg"=>'Record not found'
            ],404);
        }
        $validasi= Validator::make($input,[
            'nama_toko'=>'required|max:255',
            'nama_pemilik'=>'required|max:255',
            'alamat'=>'required|max:255',
            'latitude'=>'required|max:255',
            'longitude'=>'required|max:255',
            'gambar_toko'=>'sometimes|image|mimes:jpeg,jpg,png|max:2048'
        ]);
        if ($validasi->fails()) {
            # code...
            return response()->json([
                "status"=>FALSE,
                "msg"=>$validasi->errors()
            ],400);
        }
        if ($request->hasfile('gambar_toko')) {
            # code...
            if ($request->file('gambar_toko')->isValid()) {
                # code...
                Storage::disk('upload')->delete($agen->gambar_toko);
               
                $gambar_toko = $request->file('gambar_toko');
                $extention = $gambar_toko->getClientOriginalExtension();
        
                $namaFoto ="agen/".date('YmdHis').".".$extention;
                $upload_path='public/uploads/agen';
                $request->file('gambar_toko')->move($upload_path,$namaFoto);
                $data['gambar_toko'] = $namaFoto;
            }
    }
    $agen->update($input);
    return response()->json([
        "status" =>TRUE,
        "msg"=>'data berhasil update'
    ],200);
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
        $agen= Agen::find($id);
        if (is_null($agen)) {
            # code...
            return response()->json([
                'status' => False,
                'msg' => 'record not found',
            ],404);
        }
        $agen->delete();
        Storage::disk('upload')->delete($agen->gambar_toko);
        return response()->json([
            'status'=>TRUE,
            'msg'=>'data berhasil dihapus',
        ],200);
    }

    public function search(Request $request){
        $filterKeyword = $request->get('keyword');
        return AgenResource::collection(Agen::where('nama_toko','LIKE',"%$filterKeyword%")->get());
    }
}
