<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user= User::paginate(2);
        $filterKeyword = $request->get('keyword');
        if($filterKeyword)
        {
            $user = User::where('name','LIKE',"%$filterKeyword%")->paginate(2);
        }
        return view('user.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user.create');
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
        $data= $request->all();
        $validasi = Validator::make($data,[
            'name'=>'required|max:255',
            'email'=>'required|email|max:255|unique:users',
            'username'=>'required|max:100|unique:users',
            'password'=>'required|min:6',
        ]);
        if ($validasi->fails())
         {
            return redirect()->route('user.create')->withInput()->withErrors($validasi);
        }
        
        $data['password']=bcrypt($data['password']);
        User::create($data);
        return redirect()->route('user.index')->with('status','user berhasil ditambahkan');
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
        $user = User::findOrfail($id);
        return view('user.show',compact('user'));
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
        $user= User::findOrfail($id);
        return view('user.edit',compact('user'));
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
        $user=User::findOrfail($id);
        $data = $request->all();
        
        $validasi = Validator::make($data,[
            'name'=>'required|max:255',
            'username'=>'required|max:100|unique:users,username,'.$id,
            'email'=>'required|max:255|unique:users,email,'.$id,
            'password'=>'sometimes|nullable|min:6']);
            if($validasi->fails()){
                return redirect()->route('user.edit',[$id])->withErrors($validasi);
            }
            if ($request->input('password')) {
                $data['password']=bcrypt($data['password']);

                # code...
            }else{
                    $data= Arr::except($data,['password']);
            }
            $user->update($data);
            return redirect()->route('user.index')->with('status','user berhasil di Update');
            
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
        $data = User::findOrfail($id);
        $data->delete();
        return redirect()->route('user.index')->with('status','User berhasil dihapus');
    }
}
