@extends('layouts.template')
@section('title')
    tambah data kategori
    
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border"> 
                      @include('alert.error')
                </div>
                <div class="box-body">
                    <form class="form-horizontal" method="post" action="{{route('kategori.store')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="kategori" class="col-sm-2 control-label">Kategori</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kategori" name="kategori" value="{{old('kategori')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gambar_kategori" class="col-sm-2 control-label">gambar kategori</label>
                                <div class="col-sm-10">
                                    <input type="file" name="gambar_kategori" id="gambar_kategori" class="form-control">
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