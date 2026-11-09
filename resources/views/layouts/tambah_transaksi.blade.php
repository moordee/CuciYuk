 <!-- Penerapan template untuk halaman Tambah Transaksi @ web app CuciYuk -->

@extends('partials.master')

@section('title', 'Tambah Transaksi')

@section('content')
    <main>
        <div class="container px-4">
            <h1 class="mt-4">Tambah Transaksi</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Tambah Transaksi</li>
            </ol>
            <div class="container">
                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tanggal" id="tanggal"
                                value="{{ old('tanggal', date('Y-m-d')) }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama_pelanggan" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan"
                                value="{{ old('nama_pelanggan') }}" maxlength="100" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jenis_jasa" class="col-sm-2 col-form-label">Jenis Jasa</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="jenis_jasa" id="jenis_jasa" required>
                                <option value="">Pilih jasa</option>
                                @foreach ($jasa as $item)
                                    <option value="{{ $item->id }}" @selected((string) old('jenis_jasa') === (string) $item->id)>
                                        {{ $item->nama_jasa }} (Rp. {{ number_format($item->harga_satuan, 0, ',', '.') }}/kg)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jumlah_kg" class="col-sm-2 col-form-label">Jumlah (kg)</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="jumlah_kg" id="jumlah_kg"
                                value="{{ old('jumlah_kg') }}" min="0.01" step="any" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="status_pembayaran" class="col-sm-2 col-form-label">Status Pembayaran</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="status_pembayaran" id="status_pembayaran" required>
                                <option value="Belum dibayar" @selected(old('status_pembayaran', 'Belum dibayar') === 'Belum dibayar')>Belum dibayar</option>
                                <option value="Sudah dibayar" @selected(old('status_pembayaran') === 'Sudah dibayar')>Sudah dibayar</option>
                                <option value="Hutang" @selected(old('status_pembayaran') === 'Hutang')>Hutang</option>
                            </select>
                        </div>
                    </div>
                    <p class="text-muted">Total dihitung otomatis berdasarkan jasa dan jumlah kilogram.</p>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>

                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </main>
@endsection
