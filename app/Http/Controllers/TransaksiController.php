<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Saving;
use App\Withdrawal;

class TransaksiController extends Controller
{
     public function index()
    {
        $transactions = Withdrawal::with('savings')->get();

        return view('transaksi.index', compact('transactions'));
    }
    public function edit($id)
    {
        $saving = saving::findOrFail($id);

        return view('transaksi.edit', compact('saving'));
    }
    public function store(Request $request, $id)
    {
        $saving = saving::findOrFail($id);
        
        $withdrawal = Withdrawal::create($request->all());
        if($withdrawal->save()){
            $hitung = $saving->saldo - $withdrawal->total;

            $saving->update([
                'saldo' => $hitung,
            ]);
        }
        flash('Transkasi Pengambilan berhasil dilakukan');
        return redirect()->route('savings.anggota');
    }

}
