 <!-- Penerapan template untuk halaman Ubah Jasa @ web app CuciYuk -->

@extends('partials.master')

@section('title', 'Ubah Jasa')

@section('content')
    <!-- Put the form content here -->
    <main>
        <div class="container px-4">
            <h1 class="mt-4">Ubah Jasa</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Ubah Jasa</li>
            </ol>
            <div class="container">
                <form action="{{ route('jasa.update', $jasa->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="nama_jasa" class="col-sm-2 col-form-label">Nama Jasa</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_jasa" class="form-control" id="nama_jasa"
                                value="{{ old('nama_jasa', $jasa->nama_jasa) }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="harga_satuan" class="col-sm-2 col-form-label">Harga Satuan (Rp/kg)</label>
                        <div class="col-sm-10">
                            <input type="number" name="harga_satuan" class="form-control" id="harga_satuan"
                                value="{{ old('harga_satuan', $jasa->harga_satuan) }}" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </form>
            </div>
        </div>
    </main>
@endsection
