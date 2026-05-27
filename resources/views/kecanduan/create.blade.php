@extends('template_backend.app')

@section('content')
    <style>
        /* --- CUSTOM MODERN STYLE UNTUK FORM --- */
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
            border-top: 4px solid #1cc88a; /* Tambahan border atas hijau */
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
            border-color: #1cc88a; /* Fokus hijau */
            box-shadow: 0 0 0 0.2rem rgba(28, 200, 138, 0.25); /* Shadow hijau */
        }
        
        /* Styling untuk Icon di dalam Input */
        .input-group-text {
            border-radius: 10px 0 0 10px;
            border: 1px solid #e2e8f0;
            background-color: #f8f9fc;
            color: #1cc88a; /* Icon warna hijau */
            border-right: none;
        }
        .input-custom.has-icon {
            border-radius: 0 10px 10px 0;
            border-left: none;
        }
        
        /* Tombol Simpan & Batal */
        .btn-save-modern {
            background: linear-gradient(135deg, #1cc88a 0%, #13a673 100%); /* Gradasi hijau */
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(28, 200, 138, 0.3);
            transition: all 0.3s ease;
        }
        .btn-save-modern:hover {
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
                    <h1 class="page-header"><i class="fas fa-plus-circle text-success mr-2"></i> Tambah Tingkat Kecanduan</h1>
                    <p class="text-muted mb-0">Silakan masukkan kode, nama, deskripsi, dan solusi penanganan.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content mx-3 mb-5">
        <div class="row">
            <div class="col-lg-10 col-md-12">
                <div class="card modern-card">
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('kecanduan.store') }}" method="post">
                            @csrf
                            
                            <!-- Input Kode Kecanduan -->
                            <div class="form-group mb-4">
                                <label for="kode_kecanduan" class="form-label">Kode Tingkat Kecanduan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-custom has-icon @error('kode_kecanduan') is-invalid @enderror" name="kode_kecanduan" id="kode_kecanduan" value="{{ old('kode_kecanduan') }}" placeholder="Contoh: K01">
                                    
                                    @error('kode_kecanduan')
                                        <div class="invalid-feedback d-block mt-2">
                                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Nama Kecanduan -->
                            <div class="form-group mb-4">
                                <label for="nama_kecanduan" class="form-label">Tingkat Kecanduan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-book-medical"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-custom has-icon @error('nama_kecanduan') is-invalid @enderror" name="nama_kecanduan" id="nama_kecanduan" value="{{ old('nama_kecanduan') }}" placeholder="Contoh: Kecanduan Berat">
                                    
                                    @error('nama_kecanduan')
                                        <div class="invalid-feedback d-block mt-2">
                                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Deskripsi -->
                            <div class="form-group mb-4">
                                <label for="deskripsi" class="form-label">Deskripsi Tingkat Kecanduan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-custom has-icon @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" value="{{ old('deskripsi') }}" placeholder="Penjelasan singkat...">
                                    
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
                                <textarea class="form-control tinymce @error('solusi') is-invalid @enderror" name="solusi" id="solusi" rows="6">{{ old('solusi') }}</textarea>
                                
                                @error('solusi')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <hr class="my-4" style="border-color: #eaecf4;">

                            <!-- Tombol Aksi -->
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('kecanduan.index') }}" class="btn btn-cancel-modern mr-2">
                                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-save-modern">
                                    <i class="fas fa-save mr-1"></i> Simpan Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
