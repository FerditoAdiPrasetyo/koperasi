<?php

namespace App\Http\Controllers\Loans;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Type;
use App\Loan;
use Nexmo\Laravel\Facade\Nexmo;
use PDF;

class LoanController extends Controller
{
    public function index()
    {        
        return view('loans.index')->with(['loans' => Loan::all()]);
    }
    public function create(Type $type)
    {
        return view('loans.create', compact('type'));
    }
     public function store(Type $type, Request $request)
    {
       Loan::create([
                'user_id'           => auth()->user()->id,
                'type_id'           => $type->id,
                'jumlah_pinjaman'   => $request->jumlah_pinjaman,
                'jumlah_angsuran'   => $request->jumlah_angsuran,
                'lama_angsuran'     => $request->lama_angsuran,
                'tanggal_pengajuan' => now(),
            ]);

        flash('Pinjaman berhasil di ajukan')->success();

        return redirect()->route('submissions');
    }
     public function kalkulasi(Type $type, Request $request)
    {
        $request->validate([
            'jumlah_pinjaman' => 'required|numeric|gte:minimum_jumlah_pinjaman|lte:maksimum_jumlah_pinjaman',
            'lama_angsuran'   => 'required|numeric|gte:minimum_lama_angsuran|lte:maksimum_lama_angsuran',
        ]);


       $persen = $type->bunga / 100;
       $cicilan_pokok = $request->jumlah_pinjaman / $request->lama_angsuran;
       $bunga = $request->jumlah_pinjaman * $persen / $request->lama_angsuran;
       $angsuran = $cicilan_pokok + $bunga;

       return view('loans.kalkulasi', compact('type','request','angsuran'));
    }
    public function destroy(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);

        Nexmo::message()->send([
            'to'    => '+62' . $loan->user->phone,
            'from'  => 'Koperasi Pokemon',
            'text'  => 'Assallamualaikum wr.wb kami dari koperasi pokemon ingin memberitahukan bahwa pengajuan pinjaan anda tidak dapat kami setujui karena saldo anda kurang dari RP.2.000.000. terimakasih'
                . 'KOPERASI POKEMON'
        ]);

        $loan->delete($request->all());
        flash('Pengajuan pinjaman berhasil ditolak');

        return redirect()->route('submissions');
    }

}
