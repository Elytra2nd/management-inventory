@extends('layouts.app')

@section('content')
    <h1>Edit Pengelola Gudang</h1>
    <form action="{{ route('pengelola_gudang.update', $pengelolaGudang->pengelola_gudang_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="{{ $pengelolaGudang->username }}" required>
        </div>
        <div class="form-group">
            <label>Password (Kosongkan jika tidak ingin diubah)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
