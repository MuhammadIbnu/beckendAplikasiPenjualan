@extends('layouts.template')
@section('title')
    tambah data Supplier
    
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border"> 
                      @include('alert.error')
                </div>
                <div class="box-body">
                    <form class="form-horizontal" method="post" action="{{route('supplier.store')}}">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama_supplier" class="col-sm-2 control-label">Nama supplier</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="{{old('nama_supplier')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat_supplier" class="col-sm-2 control-label">Alamat Supplier</label>
                                <div class="col-sm-10">
                                    <textarea name="alamat_supplier" id="alamat_supplier"  class="form-control">{{old('alamat_supplier')}}</textarea>
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