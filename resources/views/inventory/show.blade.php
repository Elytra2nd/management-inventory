@extends('layouts.app')

@section('title', 'Detail Barang')

@section('content')
    <h1>Detail Barang</h1>
    <table class="table">
        <tr>
            <th>ID</th>
            <td>{{ $inventory->inventory_id }}</td>
        </tr>
        <tr>
            <th>Nama Barang</th>
            <td>{{ $inventory->nama_brg }}</td>
        </tr>
        <tr>
            <th>Kategori</th>
            <td>{{ $inventory->kategori_brg }}</td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td>{{ $inventory->jumlah }}</td>
        </tr>
        <tr>
            <th>Tanggal Masuk</th>
            <td>{{ $inventory->tgl_masuk }}</td>
        </tr>
        <tr>
            <th>Tanggal Keluar</th>
            <td>{{ $inventory->tgl_keluar }}</td>
        </tr>
        <tr>
            <th>Harga</th>
            <td>{{ $inventory->harga }}</td>
        </tr>
    </table>
    <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Kembali ke Daftar Inventory</a>
@endsection
