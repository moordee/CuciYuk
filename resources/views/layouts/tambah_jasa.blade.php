 <!-- Penerapan template untuk halaman Tambah Jasa @ web app CuciYuk -->

@extends('partials.master')

@section('title', 'Tambah Jasa')

@section('content')
    <!-- Put the form content here -->
    <main>
        <div class="container px-4">
            <h1 class="mt-4">Tambah Jasa</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Tambah Jasa</li>
            </ol>
            <div class="container">
                <form action="{{ route('jasa.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="nama_jasa" class="col-sm-2 col-form-label">Nama Jasa</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_jasa" id="nama_jasa" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="harga_satuan" class="col-sm-2 col-form-label">Harga Satuan (Rp/kg)</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="harga_satuan" id="harga_satuan" min="0" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="{{ route('jasa.index') }}" class="btn btn-secondary">Kembali</a>

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
