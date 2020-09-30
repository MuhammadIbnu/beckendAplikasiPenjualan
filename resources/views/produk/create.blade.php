@extends('layouts.template')
@section('title')
    tambah data produk
    
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border"> 
                      @include('alert.error')
                </div>
                <div class="box-body">
                    <form class="form-horizontal" method="post" action="{{route('produk.store')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama_produk" class="col-sm-2 control-label">nama produk</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{old('produk')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="kategori" class="col-sm-2 control-label">Kategori</label>
                                <div class="col-sm-10">
                                    <select name="kd_kategori" id="kd_kategori" class="from-control">
                                        @foreach ($kategori as $row)
                                            <option value="{{$row->kd_kategori}}" >{{$row->kategori}}</option>
                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="harga" class="col-sm-2 control-label">harga</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="harga" name="harga" value="{{old('harga')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gambar_kategori" class="col-sm-2 control-label">gambar produk</label>
                                <div class="col-sm-10">
                                    <input type="file" name="gambar_produk" id="gambar_produk" class="form-control">
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