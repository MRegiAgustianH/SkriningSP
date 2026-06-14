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
    </style>

    <section class="content-header mx-3 mt-3">
        <div class="container-fluid">
            <div class="row mb-3 align-items-center">
                <div class="col-sm-8">
                    <h1 class="page-header"><i class="fas fa-edit text-warning mr-2"></i> Ubah Data Gejala</h1>
                    <p class="text-muted mb-0">Perbarui informasi kode atau nama gejala kecanduan di bawah ini.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content mx-3 mb-5">
        <div class="row">
            <div class="col-lg-8 col-md-10">
                <div class="card modern-card border-top-warning" style="border-top: 4px solid #f6c23e;">
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('gejala.update', $gejala->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <!-- Input Kode Gejala -->
                            <div class="form-group mb-4">
                                <label for="kode_gejala" class="form-label">Kode Gejala</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-custom has-icon @error('kode_gejala') is-invalid @enderror" name="kode_gejala" id="kode_gejala" value="{{ old('kode_gejala', $gejala->kode_gejala) }}">
                                    
                                    @error('kode_gejala')
                                        <div class="invalid-feedback d-block mt-2">
                                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Nama Gejala -->
                            <div class="form-group mb-4">
                                <label for="nama_gejala" class="form-label">Nama Gejala</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-stethoscope"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-custom has-icon @error('nama_gejala') is-invalid @enderror" name="nama_gejala" id="nama_gejala" value="{{ old('nama_gejala', $gejala->nama_gejala) }}">
                                    
                                    @error('nama_gejala')
                                        <div class="invalid-feedback d-block mt-2">
                                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Preview Animasi Saat Ini -->
                            @if ($gejala->animasi)
                                <div class="mb-4 text-center p-3" style="background: #f8f9fc; border-radius: 12px; border: 1px dashed #cbd5e1;">
                                    <label class="form-label d-block">Animasi Saat Ini</label>
                                    @if(Str::endsWith($gejala->animasi, '.mp4'))
                                        <video src="{{ Storage::url($gejala->animasi) }}" autoplay loop muted playsinline style="max-height: 150px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);"></video>
                                    @else
                                        <img src="{{ Storage::url($gejala->animasi) }}" alt="Animasi {{ $gejala->kode_gejala }}" style="max-height: 150px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                                    @endif
                                    <div class="mt-3 custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="hapus_animasi" name="hapus_animasi" value="1">
                                        <label class="custom-control-label text-danger font-weight-600" for="hapus_animasi">Hapus Animasi</label>
                                    </div>
                                </div>
                            @endif

                            <!-- Input Animasi Baru -->
                            <div class="form-group mb-4">
                                <label for="animasi" class="form-label">Ubah Animasi Gejala (MP4/GIF/Gambar)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0"><i class="fas fa-film text-warning"></i></span>
                                    </div>
                                    <input type="file" class="form-control input-custom has-icon @error('animasi') is-invalid @enderror" name="animasi" id="animasi" accept="video/mp4,image/gif,image/png,image/jpeg,image/webp">
                                </div>    
                                    @error('animasi')
                                        <div class="invalid-feedback d-block mt-2">
                                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                        </div>
                                    </div>
                                @enderror
                                <small class="form-text text-muted mt-2"><i class="fas fa-info-circle"></i> Biarkan kosong jika tidak ingin mengubah animasi. Format: MP4, GIF, PNG, JPG, JPEG, WEBP. Maksimal 10MB.</small>
                            </div>

                            <hr class="my-4" style="border-color: #eaecf4;">

                            <!-- Tombol Aksi -->
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('gejala.index') }}" class="btn btn-cancel-modern mr-2">
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