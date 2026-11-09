@extends('layout.master')

@section('judul')
    Beranda
@endsection

@section('halamanSekarang')
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/beranda">Beranda</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/profil">Profil</a>
        </li>
    </ul>
@endsection

@section('isi')
    ini adalah isi/konten halaman beranda
@endsection
