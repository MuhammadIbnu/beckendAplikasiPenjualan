<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pegawai;
use Validator;
use App\Http\Resources\PegawaiResource;
class PegawaiController extends Controller
{
    //
    public function login_pegawai(Request $request){
        $input = $request->all();
        $validasi = Validator::make($input,[
            'username'=>'required',
            'password'=>'required'
        ]);

        if ($validasi->fails()) {
            # code...
            return response()->json([
                "status"=>FALSE,
                "msg"=>$validasi->errors()
            ],400);
            
        }
        $username = $request->input('username');
        $password = $request->input('password');

        $pegawi = Pegawai::where([
            ['username',$username],
            ['is_aktif',1]
        ])->first();
        if (is_null($pegawi)) {
            # pegawai tidak ditemukan...
            return response()->json([
                'status'=>FALSE,
                'msg'=>'username tidak ditemukan'
            ], 200);
        }else {
            # jika pegwai ditemukan...
            if (password_verify($password,$pegawi->password)) {
                # jika password sesuai...
                return response()->json([
                    'status'=>TRUE,
                    'msg'=>'username ditemukan',
                    'pegawai'=>new PegawaiResource($pegawi)
                ], 200);
            }else {
                # jika password sesuai...
                return response()->json([
                    'status'=>FALSE,
                    'msg'=>'username & password tidak sesuai',
                ], 200);
            }
        }
    }

}
