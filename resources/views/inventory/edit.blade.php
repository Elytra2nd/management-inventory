@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
    <h1>Edit Barang</h1>
    <form action="{{ route('inventory.update', $inventory->inventory_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_brg" class="form-control" value="{{ $inventory->nama_brg }}" required>
        </div>
        <div class="form-group">
            <label>Kategori Barang</label>
            <input type="text" name="kategori_brg" class="form-control" value="{{ $inventory->kategori_brg }}" required>
        </div>
        <div class="form-group">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="{{ $inventory->jumlah }}" required>
        </div>
        <div class="form-group">
            <label>Tanggal Masuk</label>
            <input type="date" name="tgl_masuk" class="form-control" value="{{ $inventory->tgl_masuk }}" required>
        </div>
        <div class="form-group">
            <label>Tanggal Keluar</label>
            <input type="date" name="tgl_keluar" class="form-control" value="{{ $inventory->tgl_keluar }}">
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $inventory->harga }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
