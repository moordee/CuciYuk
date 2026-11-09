 <!-- Penerapan template untuk halaman Jasa @ web app CuciYuk -->

@extends('partials.master')

@section('title', 'Jasa')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Jasa</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Jasa</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Jasa
                    <a class="btn btn-sm btn-primary float-end" href="/tambah_jasa">Tambah Jasa</a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Nama Jasa</th>
                                <th>Harga Satuan (Rp/kg)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No. </th>
                                <th>Nama Jasa</th>
                                <th>Harga Satuan (Rp/kg)</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($jasa as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->nama_jasa }}</td>
                                    <td>Rp. {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('jasa.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm">
                                            Ubah
                                        </a>

                                        <form action="{{ route('jasa.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Hapus data jasa ini?')">
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
