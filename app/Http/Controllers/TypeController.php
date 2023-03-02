<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use App\Http\Requests\TypesRequest;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::all();
        return view('types.index', compact('types'));
    }
    public function create()
    {
        return view('types.create');
    }
    public function store(TypesRequest $request)
    {
        Type::create($request->all());
        flash('Jenis pinjaman berhasil ditambahkan.');
        return redirect()->route('types.index');
    }
    public function edit(Type $type)
    {    
        return view('types.edit', compact('type'));
    }
    public function update(TypesRequest $request, Type $type)
    {        
        $type->update($request->all());

        flash('Jenis pinjaman berhasil diperbaharui.');

        return redirect()->route('types.index');
    }
}
