<?php

namespace App\Http\Controllers\Loans;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Loan;
use Nexmo\Laravel\Facade\Nexmo;

class SubmissionController extends Controller
{
    public function index() 
    {
        $submissions = Loan::with('user','type')->where('terverifikasi', false)->get();
        return view('submissions.index', compact('submissions'));
    }
    public function store(Loan $loan, Request $request)
    {
        $loan->update([
            'terverifikasi'         => true,
            'tanggal_persetujuan'   => now(),
        ]);

        Nexmo::message()->send([
            'to'    => '+62' . $loan->user->phone,
            'from'  => 'Koperasi Pokemon',
            'text'  => 'Assallamualaikum wr.wb kami dari koperasi pokemon ingin memberitahukan bahwa pengajuan pinjaman anda sudah kami setujui berikut ini adalah perinciannya'
                . 'Nama Peminjaman'     . $loan->user->name
                . 'Jumlah Pinjaman'     . $loan->jumlah_pinjaman
                . 'Lama Angusran'       . $loan->lama_angsuran
                . 'Tanggal Angsuran'    . $loan->created_at->format('Y-m-d')
                . 'terimakasih'
                . 'PENGURUS KOPERASI POKEMON'
        ]);
        flash('Pengajuan pinjaman berhasil di ajukan')->success();

        return redirect()->route('submissions');
    }
}
