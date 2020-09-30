@extends('layouts.template')
@section('title')
    Update data produk
    
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border"> 
                      @include('alert.error')
                </div>
                <div class="box-body">
                    <form class="form-horizontal" method="post" action="{{route('produk.update',[$produk->kd_produk])}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama_produk" class="col-sm-2 control-label">nama produk</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{$produk->nama_produk}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="kategori" class="col-sm-2 control-label">Kategori</label>
                                <div class="col-sm-10">
                                    <select name="kd_kategori" id="kd_kategori" class="from-control">
                                        @foreach ($kategori as $row)
                                        {{--jika produk kode kategori samadengan row maka dia akan tertulis selected --}}
                                            <option value="{{$row->kd_kategori}}" @if ($produk->kd_kategori == $row->kd_kategori)
                                                
                                            @endif>{{$row->kategori}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="harga" class="col-sm-2 control-label">harga</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="harga" name="harga" value="{{$produk->harga}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gambar_produk" class="col-sm-2 control-label"></label>
                               <img class="img-thumbnail" src="{{asset('uploads/'.$produk->gambar_produk)}}" width="100px">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gambar_produk" class="col-sm-2 control-label">gambar produk</label>
                                <div class="col-sm-10">
                                    <input type="file" name="gambar_produk" id="gambar_produk" class="form-control" >
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" name="tombol" class="btn btn-info pull-right">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection