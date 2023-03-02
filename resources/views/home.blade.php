@extends('layouts.app')

@section('content')
<div class="col-lg-6 col-md-6 mx-auto">
    <div class="border border-primary card card-user ">
        <div class="image">
            <img src="{{asset('asset/img/bgcice.jpg')}}" width="100%" alt="...">
        </div>
        <br>
        <div class="d-flex justify-content-center">
            <div class="content text-center">
                <img class="avatar border-white" src="{{asset('asset/img/afatar.png')}}"   alt="...">
                <h4 class="title font-weight-border">{{Auth::user()->name}}<br>
                <a href="#" class="text-muted">
                    <small>{{Auth::user()->email}}</small>
                </a>
            </h4>
            <small>{{Auth::user()->created_at->diffForHumans()}}</small>
            </div>
        </div>
        <hr>
        <div class=" text-center">
            <div class="row text-center">
                @role('anggota')
                <div class="col-md-4 col-md-offset-1">
                    <h5>
                        Rp.10000
                        <br>
                        <small class="text-muted">Saldo Simpanan</small>
                    </h5>
                </div>
                @else
                <div class="col-md-4 col-md-offset-3">
                    <h5>Rp.350000</h5>
                    <br>
                    <small>Tabungan</small>
                </div>
                @endrole
                @role('anggota')
                <div class="col-md-3">
                    <h5>
                        Rp.5000
                        <br>
                        <small class="text-muted">Dana Pinjaman</small>
                    </h5>
                </div>
                @else
                <div class="col-md-3">
                    <h5>
                        Rp.1000
                    </h5>
                    <br>
                    <small>Data Pinjaman</small>
                </div>
                @endrole
                @role('anggota')
                <div class="col-md-3">
                    <h5>
                        Rp.1000
                        <br>
                        <small class="text-muted">Total Pinjaman</small>
                    </h5>
                </div>
                @else
                <div class="col-md-3">
                    <h5>
                        Rp.1000
                    </h5>
                    <br>
                    <small>Total Pinjaman</small>
                </div>
                @endrole
                @role('anggota')
                <div class="col-md-4">
                    <h5>
                       Rp.0
                        <br>
                        <small class="text-muted">Pengajuan Pinjaman</small>
                    </h5>
                </div>
                @else
                <div class="col-md-4">
                    <h5>
                       Rp.0
                    </h5>
                    <br>
                    <small class="text-muted">Pengajuan Pinjaman</small>
                </div>
                @endrole
                @role('anggota')
                <div class="col-md-3">
                    <h5>
                      Rp.0
                        <br>
                        <a href="">
                            <small class="text-muted">Penarikan</small>
                        </a>
                    </h5>
                </div>
                @else   
                <div class="col-md-3">
                    <h5 class="mb-4">
                     penarikan
                    </h5>
                    <a href="">
                        <small class="text-muted">Penarikan</small>
                    </a>
                </div>
                @endrole
            </div>
        </div>
    </div>
</div>
@endsection
