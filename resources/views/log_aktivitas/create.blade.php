@extends('layouts.app')

@section('content')
    <h1>Tambah Log Aktivitas</h1>
    <form action="{{ route('log_aktivitas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Pengelola Gudang</label>
            <select name="username_id" class="form-control" required>
                @foreach($pengelolaGudang as $pengelola)
                    <option value="{{ $pengelola->pengelola_gudang_id }}">{{ $pengelola->username }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Aksi</label>
            <input type="text" name="aksi" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tanggal Aksi</label>
            <input type="date" name="tanggal_aksi" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
