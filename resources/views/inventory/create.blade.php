@extends('layouts.app')

@section('title', 'Tambah Barang Baru')

@section('content')
    <h1>Tambah Barang Baru</h1>
    <form action="{{ route('inventory.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_brg" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Kategori Barang</label>
            <input type="text" name="kategori_brg" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tanggal Masuk</label>
            <input type="date" name="tgl_masuk" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tanggal Keluar</label>
            <input type="date" name="tgl_keluar" class="form-control">
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

@endsection
