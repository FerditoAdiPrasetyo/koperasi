<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;

class UserController extends Controller
{
    public function create()
    {
        $roles = Role::pluck('name','id');
        return view('users.create', compact('roles'));        
    }    
  
    public function store(Request $request)
    {
        $this->validate($request, [
            'nip'           => 'required|unique:users',
            'name'          => 'bail|required|min:2',
            'email'         => 'required',
            'jenis_kelamin' => 'required',
            'jabatan'       => 'required',
            'alamat'        => 'required',
            'phone'         => 'required',
            'password'      => 'required|min:6',
            'roles'         => 'required|min:1',
        ]);

        $request->merge(['password' => bcrypt($request->get('password'))]);

        if($user = User::create($request->except('roles'))){
            $user->syncRoles($request->get('roles'));

            flash()->success('Pengguna berhasil ditambahkan');

        }else{
            flash()->error('Tidak dapat menambahkan pengguna');
        }

        return redirect()->route('anggota.index');
    }
    public function edit($id)
    {
        $data = [
            'pegawai'   => User::findOrFail($id),
            'roles'     => Role::pluck('name', 'id'),
        ];
        return view('users.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->fill($request->except('roles'));

        $user->save();
        $user->syncRoles($request->get('roles'));

        flash()->success('Data pengguna berhasil di perbarui');
        
        return redirect()->route('anggota.index');
    }
    
  
}
