<html>
    <head>
        <title></title>
    </head>
    <body>
        <h3>Report Penjualan Produk</h3>
        <hr/>
        <table style="width:100%" border="1">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Tanggal</th>
                    <th>Agen</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjualan as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->produk->nama_produk }}</td>
                        <td>{{ $row->jumlah }}</td>
                        <td>@rupiah($row->harga)</td>
                        <td>{{ $row->transaksi->tgl_penjualan }}</td>
                        <td>{{ $row->transaksi->agen->nama_toko }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>