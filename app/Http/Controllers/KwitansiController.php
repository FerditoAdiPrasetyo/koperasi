<?php

namespace App\Http\Controllers;

use PDF;
use App\Withdrawal;
use Illuminate\Http\Request;

class KwitansiController extends Controller
{
    public function show($id)
    {
        $withdrawals = Withdrawal::findOrFail($id);

        $pdf = PDF::loadView('transaksi.all', compact('withdrawals'))->setPaper('a5', 'potrait');

        return $pdf->stream('kwitansi.pdf');
    }
}
