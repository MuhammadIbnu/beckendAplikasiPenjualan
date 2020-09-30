@extends('layouts.template')
@section('title')
    tambah data Transaksi Masuk
    
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border"> 
                      @include('alert.error')
                </div>
                <div class="box-body">
                    <form class="form-horizontal" method="post" action="{{route('transaksi_masuk.store')}}">
                        {{csrf_field()}}
                        <div class="box-body">

                            <div class="form-group">
                                <label for="kd_produk" class="col-sm-2 control-label">Produk</label>
                                <div class="col-sm-10">
                                    <select name="kd_produk" id="kd_produk" class="form-control" >
                                        @foreach ($produk as $row)
                                    <option value="{{$row->kd_produk}}">{{$row->nama_produk}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="kd_supplier" class="col-sm-2 control-label">supplier</label>
                                <div class="col-sm-10">
                                    <select name="kd_supplier" id="kd_supplier" class="form-control" >
                                        @foreach ($supplier as $row)
                                    <option value="{{$row->kd_supplier}}">{{$row->nama_supplier}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                           

                            <div class="form-group">
                                <label for="tgl_transaksi" class="col-sm-2 control-label">tanggal transaksi</label>
                                <div class="col-sm-10">
                                    <input type="text"  class="form-control datepicker" name="tgl_transaksi" id="tgl_transaksi" value="{{old('tgl_transaksi')}}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="jumlah" class="col-sm-2 control-label">Jumlah</label>
                                <div class="col-sm-10">
                                    <input type="text"  class="form-control" name="jumlah" id="jumlah" type="number" value="{{old('jumlah')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="harga" class="col-sm-2 control-label">Harga</label>
                                <div class="col-sm-10">
                                    <input type="text"  class="form-control" name="harga" id="harga" type="number" value="{{old('harga')}}">
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