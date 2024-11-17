<!-- resources/views/laporan/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Laporan</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('laporan.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="judul_laporan">Judul Laporan</label>
            <input type="text" name="judul_laporan" class="form-control" required value="{{ old('judul_laporan') }}">
        </div>

        <div class="form-group mb-3">
            <label for="tanggal_laporan">Tanggal Laporan</label>
            <input type="date" name="tanggal_laporan" class="form-control" required value="{{ old('tanggal_laporan') }}">
        </div>

        <div class="form-group mb-3">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="pengelola_gudang_id">Pengelola Gudang</label>
            <select name="pengelola_gudang_id" class="form-control" required>
                <option value="">Pilih Pengelola Gudang</option>
                @foreach($pengelolaGudang as $pg)
                    <option value="{{ $pg->pengelola_gudang_id }}" {{ old('pengelola_gudang_id') == $pg->pengelola_gudang_id ? 'selected' : '' }}>
                        {{ $pg->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="inventory_id">Inventory</label>
            <select name="inventory_id" class="form-control" required>
                <option value="">Pilih Inventory</option>
                @foreach($inventory as $inv)
                    <option value="{{ $inv->inventory_id }}" {{ old('inventory_id') == $inv->inventory_id ? 'selected' : '' }}>
                        {{ $inv->nama_barang }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Status default sebagai hidden input -->
        <input type="hidden" name="status_laporan" value="pending">

        <div class="form-group">
            <button type="submit" class="btn btn-success">Simpan Laporan</button>
            <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
