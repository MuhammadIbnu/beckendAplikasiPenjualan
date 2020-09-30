@extends('layouts.template')

@section('title')
    Data produk
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    @if (Request::get('keyword'))
                        <a href="{{route('produk.index')}}" class="btn btn-success">Back</a>
                    @else
                    <a href="{{route('produk.create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>create</a>
                    @endif
                    <form action="{{route('produk.index')}}" method="get">
                        <div class="fore-group">
                            <label for="keyword" class="col-sm-2 control-label">Search By name</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="keyword" name="keyword" value="{{Request::get('keyword')}}">
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </div>
                    </form>

                    <form action="{{route('produk.index')}}" method="get">
                        <div class="fore-group">
                            <label for="kd_kategori" class="col-sm-2 control-label">Search By Kategori</label>
                            <div class="col-sm-4">
                                <select name="kd_kategori" id="kd_kategori" class="form-control">
                                    @foreach ($kategori as $row)
                                    <option value="{{$row->kd_kategori}}">{{$row->kategori}}
                                        
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </div>
                    </form>
                   
                </div>
                <div class="box-body">
                    @if (Request::get('keyword'))
                        <div class="alert alert-success alert-black">hasil pencarian produk dangan keyword: <b>{{Request::get('keyword')}}</b></div>
                    @endif

                    @if (Request::get('kd_kategori'))
                        <div class="alert alert-success alert-black">hasil pencarian produk dangan keyword: <b>{{$nama_kategori}}</b></div>
                    @endif
                        @include('alert.success')
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>nama produk</th>
                                <th>nama kategori</th>
                                <th>harga</th>
                                <th>gambar produk</th>
                                <th>stock</th>
                                <th width="30%">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $row)
                                <tr>
                                    <td>{{$loop->iteration + ($produk->perpage() *($produk->currentPage()-1))}}</td>
                                    <td>{{$row->nama_produk}}</td>
                                    <td>{{$row->kategori->kategori}}</td>
                                    <td>@rupiah($row->harga)</td>
                                    <td><img src="{{asset('uploads/'.$row->gambar_produk)}}" width="100px" alt="" class="img-thumbnail"></td>
                                    <td>{{$row->stock}}</td>
                                    <td>
                                        <form method="post" action="{{route('produk.destroy',[$row->kd_produk])}}" onsubmit="return confirm('apakah anda yakin akan menghapus data ini?')">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <a href="{{route('produk.edit',[$row->kd_produk])}}" class="btn btn-warning">Edit</a>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$produk->appends(Request::All())->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection