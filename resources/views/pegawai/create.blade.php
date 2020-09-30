@extends('layouts.template')
@section('title')
    tambah data pegawai
    
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border"> 
                      @include('alert.error')
                </div>
                <div class="box-body">
                    <form class="form-horizontal" method="post" action="{{route('pegawai.store')}}">
                        {{csrf_field()}}
                        <div class="box-body">
                            
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">UserName</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username" name="username" value="{{old('username')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nama_pegawai" class="col-sm-2 control-label">Nama Pegawai</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" value="{{old('nama_pegawai')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="password" name="password" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="jk" class="col-sm-2 control-label">jenis kelamin</label>
                                <div class="col-sm-10">
                                    <select name="jk" id="jk" class="form-control">
                                        <option value="PRIA">Pria</option>
                                        <option value="WANITA">Wanita</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat" class="col-sm-2 control-label">alamat</label>
                                <div class="col-sm-10">
                                   <textarea name="alamat" id="alamat" class="form-control">{{old('alamat')}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="is_aktif" class="col-sm-2 control-label">status</label>
                                <div class="col-sm-10">
                                    <select name="is_aktif" id="is_aktif" class="form-control">
                                        <option value="1">Aktif</option>
                                        <option value="0">tidak aktif</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" name="tombol" class="btn btn-info pull-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection