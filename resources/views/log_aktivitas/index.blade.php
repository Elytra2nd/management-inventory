@extends('layouts.app')

@section('content')
    <h1>Daftar Log Aktivitas</h1>
    <a href="{{ route('log_aktivitas.create') }}" class="btn btn-primary">Tambah Log Aktivitas</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Aksi</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logAktivitas as $log)
                <tr>
                    <td>{{ $log->log_id }}</td>
                    <td>{{ $log->pengelolaGudang->username }}</td>
                    <td>{{ $log->aksi }}</td>
                    <td>{{ $log->tanggal_aksi }}</td>
                    <td>{{ $log->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
