 <!-- Penerapan template untuk halaman Dashboard @ web app CuciYuk -->

@extends('partials.master')

@section('title', 'Beranda')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Beranda</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Beranda</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">{{ $jumlahJasa }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('jasa.index') }}">Jasa</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">{{ $jumlahTransaksi }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('transaksi.index') }}">Transaksi</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">
                            {{ $transaksiBelumDibayar }}
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('transaksi.index') }}">Belum Bayar / Hutang</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Rp. {{ number_format($pendapatanHariIni, 0, ',', '.') }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('transaksi.index') }}">Pendapatan Hari Ini</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Transaksi Terbaru
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Nama Pelanggan</th>
                                <th>Nama Jasa</th>
                                <th>Banyaknya (kg)</th>
                                <th>Total Pembayaran</th>
                                <th>Status Pembayaran</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Nama Pelanggan</th>
                                <th>Nama Jasa</th>
                                <th>Banyaknya (kg)</th>
                                <th>Total Pembayaran</th>
                                <th>Status Pembayaran</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($transaksiTerbaru as $item)
                                <tr>
                                    <td>{{ $item->id_transaksi }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->nama_pelanggan ?? '-' }}</td>
                                    <td>{{ $item->nama_jasa ?? 'Jasa tidak ditemukan' }}</td>
                                    <td>{{ $item->jumlah_kg }}</td>
                                    <td>Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                                    <td>{{ $item->status_pembayaran }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada transaksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
