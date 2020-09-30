<?php

namespace App\Exports;

use App\TransaksiDetail;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class TransaksiDetailExport implements FromView,ShouldAutoSize
{
    public function view(): View
    {
        return view('report_penjualan.cetak_excel', [
            'transaksi' => TransaksiDetail::orderBy('created_at')->get()
        ]);
    }
}