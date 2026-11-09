@extends('layout.master')

@section('judul')
    Profil
@endsection

@section('halamanSekarang')
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="/beranda">Beranda</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/profil">Profil</a>
        </li>
    </ul>
@endsection

@section('isi')
    ini adalah isi/konten halaman profil
@endsection
