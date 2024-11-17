@extends('layouts.app')

@section('content')
    <h1>Daftar Pengelola Gudang</h1>
    <a href="{{ route('pengelola_gudang.create') }}" class="btn btn-primary">Tambah Pengelola Gudang</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengelolaGudang as $pengelola)
                <tr>
                    <td>{{ $pengelola->pengelola_gudang_id }}</td>
                    <td>{{ $pengelola->username }}</td>
                    <td>
                        <a href="{{ route('pengelola_gudang.edit', $pengelola->pengelola_gudang_id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('pengelola_gudang.destroy', $pengelola->pengelola_gudang_id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
