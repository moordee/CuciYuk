 <!-- Penerapan template untuk halaman Transaksi @ web app CuciYuk -->

@extends('partials.master')

@section('title', 'Transaksi')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Transaksi</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Transaksi</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Transaksi
                    <a class="btn btn-sm btn-primary float-end" href="/tambah_transaksi">Tambah Transaksi</a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Nama Pelanggan</th>
                                <th>Jenis Jasa</th>
                                <th>Jumlah (kg)</th>
                                <th>Total</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Nama Pelanggan</th>
                                <th>Jenis Jasa</th>
                                <th>Jumlah (kg)</th>
                                <th>Total</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($transaksi as $item)
                                <tr>
                                    <td>{{ $item->id_transaksi }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->nama_pelanggan ?? '-' }}</td>
                                    <td>{{ $item->nama_jasa ?? 'Jasa tidak ditemukan' }}</td>
                                    <td>{{ $item->jumlah_kg }}</td>
                                    <td>Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                                    <td>{{ $item->status_pembayaran }}</td>
                                    <td>
                                        <a href="{{ route('transaksi.cetak', $item->id_transaksi) }}"
                                            class="btn btn-info btn-sm" target="_blank" rel="noopener">
                                            Cetak
                                        </a>
                                        <a href="{{ route('transaksi.edit', $item->id_transaksi) }}"
                                            class="btn btn-warning btn-sm">
                                            Ubah
                                        </a>

                                        <form action="{{ route('transaksi.destroy', $item->id_transaksi) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Hapus transaksi ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
