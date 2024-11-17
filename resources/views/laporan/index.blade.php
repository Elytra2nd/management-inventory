@extends('layouts.app')

@section('title', 'Daftar Laporan')

@push('css')
   <style>
       .header-container {
           display: flex;
           justify-content: space-between;
           align-items: center;
           margin-bottom: 20px;
       }

       .button-container {
           display: flex;
           gap: 10px;
       }

       .back-btn {
           display: flex;
           align-items: center;
           gap: 5px;
       }

       .status-badge {
           padding: 6px 12px;
           border-radius: 20px;
           font-size: 0.875rem;
           font-weight: 500;
       }

       .status-pending {
           background-color: #fef3c7;
           color: #92400e;
       }

       .status-approved {
           background-color: #dcfce7;
           color: #166534;
       }

       .status-rejected {
           background-color: #fee2e2;
           color: #991b1b;
       }

       .description-cell {
           max-width: 300px;
           white-space: nowrap;
           overflow: hidden;
           text-overflow: ellipsis;
       }
   </style>
@endpush

@section('content')
   <div class="header-container">
       <h1>Daftar Laporan</h1>
       <div class="button-container">
           <a href="{{ route('dashboard') }}" class="btn btn-secondary back-btn">
               <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
           </a>
           <a href="{{ route('laporan.create') }}" class="btn btn-primary">
               <i class="fas fa-plus"></i> Tambah Laporan
           </a>
       </div>
   </div>

   @if(session('success'))
       <div class="alert alert-success alert-dismissible fade show" role="alert">
           {{ session('success') }}
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
   @endif

   @if(session('error'))
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
           {{ session('error') }}
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
   @endif

   <div class="card">
       <div class="card-body">
           <div class="table-responsive">
               <table class="table table-striped table-hover">
                   <thead>
                       <tr>
                           <th>ID</th>
                           <th>Judul</th>
                           <th>Deskripsi</th>
                           <th>Tanggal</th>
                           <th>Status</th>
                           <th>Aksi</th>
                       </tr>
                   </thead>
                   <tbody>
                       @foreach($laporan as $lapor)
                           <tr>
                               <td>{{ $lapor->laporan_id }}</td>
                               <td>{{ $lapor->judul_laporan }}</td>
                               <td class="description-cell" title="{{ $lapor->deskripsi }}">
                                   {{ $lapor->deskripsi ?? 'Tidak ada deskripsi' }}
                               </td>
                               <td>{{ \Carbon\Carbon::parse($lapor->tanggal_laporan)->format('d F Y') }}</td>
                               <td>
                                   <span class="status-badge
                                       {{ strtolower($lapor->status_laporan) === 'pending' ? 'status-pending' : '' }}
                                       {{ strtolower($lapor->status_laporan) === 'approved' ? 'status-approved' : '' }}
                                       {{ strtolower($lapor->status_laporan) === 'rejected' ? 'status-rejected' : '' }}
                                   ">
                                       {{ $lapor->status_laporan }}
                                   </span>
                               </td>
                               <td>
                                   <a href="{{ route('laporan.edit', $lapor->laporan_id) }}" class="btn btn-warning btn-sm">
                                       <i class="fas fa-edit"></i> Edit
                                   </a>
                               </td>
                           </tr>
                       @endforeach
                   </tbody>
               </table>

               @if($laporan->isEmpty())
                   <div class="text-center py-4">
                       <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                       <p class="text-muted">Belum ada laporan yang ditambahkan</p>
                   </div>
               @endif
           </div>
       </div>
   </div>
@endsection

@push('scripts')
   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <script>
       // Auto close alerts after 5 seconds
       window.setTimeout(function() {
           $(".alert").fadeTo(500, 0).slideUp(500, function(){
               $(this).remove();
           });
       }, 5000);
   </script>
@endpush
