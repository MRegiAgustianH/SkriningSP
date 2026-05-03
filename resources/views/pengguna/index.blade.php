@extends('template_backend.app')

@section('content')
    <style>
        /* --- CUSTOM MODERN STYLE UNTUK HALAMAN DATA PENGGUNA --- */
        .page-header {
            color: #2c3e50;
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 0;
        }
        .modern-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border-top: 4px solid #4e73df; /* Aksen Biru Primary untuk Manajemen User */
        }
        .btn-add-modern {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(78, 115, 223, 0.3);
            transition: all 0.3s ease;
        }
        .btn-add-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(78, 115, 223, 0.4);
            color: white;
        }
        
        /* Styling Tabel */
        .table-custom {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }
        .table-custom thead th {
            background-color: #f8f9fc;
            color: #5a5c69;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 700;
            border-bottom: 2px solid #e3e6f0;
            padding: 15px;
        }
        .table-custom tbody td {
            vertical-align: middle;
            color: #3a3b45;
            padding: 12px 15px;
            border-bottom: 1px solid #eaecf4;
        }
        .table-custom tbody tr:hover {
            background-color: #f8f9fc;
        }
        
        /* Styling Tombol Aksi */
        .action-btn {
            border-radius: 6px;
            padding: 6px 12px;
            transition: all 0.2s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            margin: 0 2px;
        }
        .action-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .form-action {
            display: inline-block;
            margin: 0;
        }

        /* Badge Khusus User */
        .badge-role {
            background-color: #e2e8f0;
            color: #4a5568;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-block;
        }
        .badge-role.admin {
            background-color: #e6f2ff;
            color: #4e73df;
        }
        .username-text {
            font-weight: 600;
            color: #858796;
            font-size: 0.95rem;
        }
    </style>

    <section class="content-header mx-3 mt-3">
        <div class="container-fluid">
            <div class="row mb-3 align-items-center">
                <div class="col-sm-6">
                    <h1 class="page-header"><i class="fas fa-users-cog text-primary mr-2"></i> Data Pengguna</h1>
                    <p class="text-muted mb-0">Kelola akun administrator dan pengguna sistem aplikasi.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content mx-3 mb-5">
        <div class="card modern-card">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="{{ route('pengguna.create') }}" class="btn btn-add-modern">
                        <i class="fas fa-user-plus mr-1"></i> Tambah Pengguna
                    </a>
                </div>
                
                <div class="table-responsive mt-2">
                    <table class="table table-custom" id="datatable" data-ordering="false">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th width="30%">Nama Lengkap</th>
                                <th>Username</th>
                                <th class="text-center">Role / Hak Akses</th>
                                <th class="text-center" width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengguna as $row)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="font-weight-bold" style="color: #2c3e50;">
                                            <i class="fas fa-user-circle text-gray-400 mr-2"></i>{{ $row->name }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="username-text">
                                            <i class="fas fa-at fa-sm mr-1"></i>{{ $row->username }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <!-- Menyesuaikan warna badge jika role admin, jika ada role lain bisa disesuaikan -->
                                        <span class="badge-role {{ strtolower($row->role->name) == 'admin' ? 'admin' : '' }}">
                                            <i class="fas fa-shield-alt mr-1"></i> {{ $row->role->name }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('pengguna.destroy', $row->id) }}" method="POST" class="form-action">
                                            @csrf
                                            @method('DELETE')
                                            
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('pengguna.edit', $row->id) }}" class="btn btn-warning action-btn text-white" title="Edit Akun">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            <!-- Tombol Hapus (Disembunyikan untuk akun yang sedang login) -->
                                            @if (auth()->user()->username != $row->username)
                                                <button class="btn btn-danger action-btn delete-confirm" type="submit" title="Hapus Akun">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').on('click', '.delete-confirm', function(event) {
                var form = $(this).closest("form");
                event.preventDefault();
                swal({
                        title: "Konfirmasi Hapus",
                        text: "Apakah Anda yakin ingin menghapus akun pengguna ini? Hak akses mereka akan dicabut secara permanen.",
                        icon: "warning",
                        buttons: ["Batal", "Ya, Hapus!"],
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        }
                    });
            });
        });

        @if (session()->has('success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
            }
            toastr.success('{{ session('success') }}');
        @elseif (session()->has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
            }
            toastr.error('{{ session('error') }}');
        @endif
    </script>
@endsection