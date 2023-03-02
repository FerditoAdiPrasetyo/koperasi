<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Loan;
use PDF;


class LoanController extends Controller
{
    public function moon(Request $request)
    {
        if ($request->has('dari_tgl')) {
            $loans = Loan::whereBetween('created_at', [request('tanggal_persetujuan',[request('dari_tgl')]), request('tgl_akhir'),request('sampai_tgl')])
            ->get();
        }

        $pdf = PDF::loadView('cetak.loans.moon', compact('loans'))->setPaper('a3', 'landscape');

        return $pdf->stream('laporan_bulanan_loans.pdf');
    }
    public function all()
    {
        $loans = Loan::all();

        $pdf = PDF::loadView('cetak.loans.all', compact('loans'))->setPaper('a3', 'landscape');

        return $pdf->stream('laporan_all_loans_pdf');
    }
}
