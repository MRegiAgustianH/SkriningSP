@extends('template_backend.app')

@section('content')
    <style>
        /* --- CUSTOM MODERN STYLE UNTUK FORM EDIT --- */
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
            border-color: #f6c23e; /* Warna fokus disesuaikan jadi kuning/warning untuk mode edit */
            box-shadow: 0 0 0 0.2rem rgba(246, 194, 62, 0.25);
        }
        
        /* Styling untuk Icon di dalam Input */
        .input-group-text {
            border-radius: 10px 0 0 10px;
            border: 1px solid #e2e8f0;
            background-color: #f8f9fc;
            color: #f6c23e; /* Warna icon mengikuti tema edit */
            border-right: none;
        }
        .input-custom.has-icon {
            border-radius: 0 10px 10px 0;
            border-left: none;
        }
        
        /* Tombol Simpan & Batal */
        .btn-update-modern {
            background: linear-gradient(135deg, #1cc88a 0%, #13a673 100%);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(28, 200, 138, 0.3);
            transition: all 0.3s ease;
        }
        .btn-update-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(28, 200, 138, 0.4);
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

        /* Khusus untuk TinyMCE */
        .tox-tinymce {
            border-radius: 10px !important;
            border: 1px solid #e2e8f0 !important;
        }
    </style>

    <section class="content-header mx-3 mt-3">
        <div class="container-fluid">
            <div class="row mb-3 align-items-center">
                <div class="col-sm-8">
                    <h1 class="page-header"><i class="fas fa-edit text-warning mr-2"></i> Ubah Data Jenis Kecanduan</h1>
                    <p class="text-muted mb-0">Perbarui informasi tingkat/jenis kecanduan beserta penanganannya di bawah ini.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content mx-3 mb-5">
        <div class="row">
            <div class="col-lg-10 col-md-12">
                <div class="card modern-card border-top-warning" style="border-top: 4px solid #f6c23e;">
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('penyakit.update', $penyakit->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            
                            <!-- Input Kode Penyakit -->
                            <div class="form-group mb-4">
                                <label for="kode_penyakit" class="form-label">Kode Jenis Kecanduan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-custom has-icon @error('kode_penyakit') is-invalid @enderror" name="kode_penyakit" id="kode_penyakit" value="{{ old('kode_penyakit', $penyakit->kode_penyakit) }}">
                                    
                                    @error('kode_penyakit')
                                        <div class="invalid-feedback d-block mt-2">
                                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Nama Penyakit -->
                            <div class="form-group mb-4">
                                <label for="nama_penyakit" class="form-label">Jenis Kecanduan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-book-medical"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-custom has-icon @error('nama_penyakit') is-invalid @enderror" name="nama_penyakit" id="nama_penyakit" value="{{ old('nama_penyakit', $penyakit->nama_penyakit) }}">
                                    
                                    @error('nama_penyakit')
                                        <div class="invalid-feedback d-block mt-2">
                                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Deskripsi -->
                            <div class="form-group mb-4">
                                <label for="deskripsi" class="form-label">Deskripsi Jenis Kecanduan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-custom has-icon @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" value="{{ old('deskripsi', $penyakit->deskripsi) }}">
                                    
                                    @error('deskripsi')
                                        <div class="invalid-feedback d-block mt-2">
                                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Solusi (TinyMCE) -->
                            <div class="form-group mb-4">
                                <label for="solusi" class="form-label"><i class="fas fa-lightbulb text-warning mr-1"></i> Solusi Penanganan</label>
                                <textarea class="form-control tinymce @error('solusi') is-invalid @enderror" name="solusi" id="solusi" rows="6">{{ old('solusi', $penyakit->solusi) }}</textarea>
                                
                                @error('solusi')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <hr class="my-4" style="border-color: #eaecf4;">

                            <!-- Tombol Aksi -->
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('penyakit.index') }}" class="btn btn-cancel-modern mr-2">
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