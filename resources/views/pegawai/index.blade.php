@extends('layouts.template')

@section('title')
    Data Pegawai
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    @if (Request::get('keyword'))
                        <a href="{{route('pegawai.index')}}" class="btn btn-success">Back</a>
                    @else
                    <a href="{{route('pegawai.create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>create</a>
                    @endif
                    <form action="{{route('pegawai.index')}}" method="get">
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
                   
                </div>
                <div class="box-body">
                    @if (Request::get('keyword'))
                        <div class="alert alert-success alert-black">hasil pencarian dangan keyword: <b>{{Request::get('keyword')}}</b></div>
                    @endif
                        @include('alert.success')
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>username</th>
                                <th>nama_pegawai</th>
                                <th>jenis Kelamain</th>
                                <th>alamat</th>
                                <th>status</th>
                                <th width="30%">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pegawai as $row)
                                <tr>
                                    <td>{{$loop->iteration + ($pegawai->perPage() *($pegawai->currentPage()-1))}} </td>
                                    <td>{{$row->username}}</td>
                                    <td>{{$row->nama_pegawai}}</td>
                                    <td>{{$row->jk}}</td>
                                    <td>{{$row->alamat}}</td>
                                    <td>@if ($row->is_aktif == 1) Aktif @else tidak aktif
                                        
                                    @endif</td>
                                    <td>
                                        <form method="post" action="{{route('pegawai.destroy',[$row->username])}}" onsubmit="return confirm('apakah anda yakin akan menghapus data ini?')">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <a href="{{route('pegawai.edit',[$row->username])}}" class="btn btn-warning">Edit</a>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                           {{-- <a href="{{route('pegawai.show',[$row->username])}}" class="btn btn-info">Detail</a>--}}
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$pegawai->appends(Request::All())->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection