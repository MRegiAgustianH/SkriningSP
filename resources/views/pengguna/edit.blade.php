@extends('template_backend.app')

@section('content')
    <style>
        /* --- CUSTOM MODERN STYLE UNTUK FORM PENGGUNA --- */
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
            border-top: 4px solid #4e73df; /* Aksen Biru Primary */
        }
        .form-label {
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 8px;
        }
        .input-custom {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            height: auto;
        }
        .input-custom:focus {
            border-color: #4e73df; /* Fokus warna biru */
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        /* Styling untuk Icon di dalam Input */
        .input-group-text {
            border-radius: 10px 0 0 10px;
            border: 1px solid #e2e8f0;
            background-color: #f8f9fc;
            color: #4e73df; /* Icon warna biru */
            border-right: none;
        }
        .input-custom.has-icon {
            border-radius: 0 10px 10px 0;
            border-left: none;
        }
        
        /* Tombol Simpan & Batal */
        .btn-update-modern {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(78, 115, 223, 0.3);
            transition: all 0.3s ease;
        }
        .btn-update-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(78, 115, 223, 0.4);
            color: white;
        }
        .btn-cancel-modern {
            background: #f8f9fc;
            color: #5a5c69;
            border: 1px solid #e3e6f0;
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-cancel-modern:hover {
            background: #eaecf4;
            color: #3a3b45;
        }
    </style>

    <section class="content-header mx-3 mt-3">
        <div class="container-fluid">
            <div class="row mb-3 align-items-center">
                <div class="col-sm-8">
                    <h1 class="page-header"><i class="fas fa-user-edit text-primary mr-2"></i> Ubah Data Pengguna</h1>
                    <p class="text-muted mb-0">Perbarui informasi profil atau hak akses akun pengguna di bawah ini.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content mx-3 mb-5">
        <div class="row">
            <div class="col-lg-8 col-md-10">
                <div class="card modern-card">
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('pengguna.update', $pengguna->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            
                            <!-- Input Nama Lengkap -->
                            <div class="form-group mb-4">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-custom has-icon @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $pengguna->name) }}">
                                    
                                    @error('name')
                                        <div class="invalid-feedback d-block mt-2">
                                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Username -->
                            <div class="form-group mb-4">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-custom has-icon @error('username') is-invalid @enderror" name="username" id="username" value="{{ old('username', $pengguna->username) }}">
                                    
                                    @error('username')
                                        <div class="invalid-feedback d-block mt-2">
                                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Role -->
                            <div class="form-group mb-4">
                                <label for="role_id" class="form-label">Role / Hak Akses</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
                                    </div>
                                    <select class="form-control input-custom has-icon @error('role_id') is-invalid @enderror" name="role_id" id="role_id">
                                        <option value="">-- Pilih Role Pengguna --</option>
                                        @foreach ($roles as $row)
                                            <!-- Ditambahkan old() agar jika validasi gagal, pilihan tidak reset -->
                                            <option value="{{ $row->id }}" {{ old('role_id', $pengguna->role_id) == $row->id ? 'selected' : '' }}>
                                                {{ $row->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                    @error('role_id')
                                        <div class="invalid-feedback d-block mt-2">
                                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <hr class="my-4" style="border-color: #eaecf4;">

                            <!-- Tombol Aksi -->
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('pengguna.index') }}" class="btn btn-cancel-modern mr-2">
                                    <i class="fas fa-arrow-left mr-1"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-update-modern">
                                    <i class="fas fa-save mr-1"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection