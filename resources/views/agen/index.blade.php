@extends('layouts.template')
@section('title')
    Data Agen
@endsection
@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>


    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">

                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th with="5%">No</th>
                                <th>nama toko</th>
                                <th>nama pemilik</th>
                                <th>alamat</th>
                                <th>Lat</th>
                                <th>Long</th>
                                <th>gambar toko</th>
                            </tr>
                            <tbody>
                                @foreach ($agen as $row)
                                    <tr>
                                        <td>{{$loop->iteration + ($agen->perpage() *($agen->currentPage()-1))}} </td>
                                        <td>{{$row->nama_toko}}</td>
                                        <td>{{$row->nama_pemilik}}</td>
                                        <td>{{$row->alamat}}</td>
                                        <td>{{$row->latitude}}</td>
                                        <td>{{$row->longitude}}</td>
                                        <td><img src="{{asset('uploads/'.$row->gambar_toko)}}" width="100px" class="img-thumbnail" alt=""></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </thead>
                    </table>
                    {{$agen->links()}}
                    <div id="map" style=" width:100%; height:400px;">
                        <script>
                            var locations = <?php echo $hasil_lat_long; ?>;
                            var map = L.map('map').setView([{{ $lokasi->latitude }}, {{ $lokasi->longitude }}], 18);
                            mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
                            L.tileLayer(
                                'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; ' + mapLink + ' Contributors',
                                maxZoom: 18,
                                }).addTo(map);
                    
                            for (var i = 0; i < locations.length; i++) {
                                marker = new L.marker([locations[i][1],locations[i][2]])
                                    .bindPopup(locations[i][0])
                                    .addTo(map);
                            }
                
                        </script>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection