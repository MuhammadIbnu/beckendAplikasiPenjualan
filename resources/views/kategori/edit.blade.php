@extends('layouts.template')
@section('title')
    Update data Kategori
    
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border"> 
                      @include('alert.error')
                </div>
                <div class="box-body">
                    <form class="form-horizontal" method="post" action="{{route('kategori.update',[$kategori->kd_kategori])}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="kategori" class="col-sm-2 control-label">nama kategori</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kategori" name="kategori" value="{{$kategori->kategori}}">
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <label for="gambar_kategori" class="col-sm-2 control-label"></label>
                               <img class="img-thumbnail" src="{{asset('uploads/'.$kategori->gambar_kategori)}}" width="100px">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gambar_kategori" class="col-sm-2 control-label">gambar kategori</label>
                                <div class="col-sm-10">
                                    <input type="file" name="gambar_kategori" id="gambar_kategori" class="form-control" >
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