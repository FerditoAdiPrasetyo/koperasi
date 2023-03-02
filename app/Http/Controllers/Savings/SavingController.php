<?php

namespace App\Http\Controllers\Savings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Saving;

class SavingController extends Controller
{
    public function index()
    {
        $users = Saving::all();
        return view('savings.index', compact('users'));
    }
    public function create()
    {
        $roles = User::all();
        return view('savings.create',compact('roles'));
    }
      public function store(Request $request)
    {

        Saving::create([
            'user_id'   => request('user_id'),
            'saldo'     => request('saldo')
        ]);

        flash('Tabungan anda berhasil ditambahkan.')->success();

        return redirect()->route('savings.anggota');
    }
    public function edit($id)
    {
        $saving = saving::findOrFail($id);

        return view('savings.edit', compact('saving'));
    }
    public function update(Request $request, $id)
    {
        $saving = saving::findOrFail($id);

        $hitung = $saving->saldo + $request->saldo;
        $saving->update([
            'saldo' => $hitung
        ]);

        flash('Tabungan anda berhasil ditambahkan.')->success();

        return redirect()->route('savings.anggota');
    }
}
