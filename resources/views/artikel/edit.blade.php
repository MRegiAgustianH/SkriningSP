@extends('template_backend.app')

@section('content')
    <style>
        /* --- CUSTOM MODERN STYLE UNTUK FORM ARTIKEL --- */
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
            border-top: 4px solid #667eea; /* Aksen ungu/indigo untuk artikel */
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
            border-color: #667eea; /* Fokus indigo */
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        /* Styling untuk Icon di dalam Input */
        .input-group-text {
            border-radius: 10px 0 0 10px;
            border: 1px solid #e2e8f0;
            background-color: #f8f9fc;
            color: #667eea; /* Icon warna indigo */
            border-right: none;
        }
        .input-custom.has-icon {
            border-radius: 0 10px 10px 0;
            border-left: none;
        }
        
        /* Tombol Simpan & Batal */
        .btn-update-modern {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); /* Gradasi indigo/ungu */
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(118, 75, 162, 0.3);
            transition: all 0.3s ease;
        }
        .btn-update-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(118, 75, 162, 0.4);
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

        /* Styling Preview Gambar */
        .img-preview-container {
            display: inline-block;
            position: relative;
            margin-bottom: 15px;
        }
        .img-preview {
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 3px solid #ffffff;
            max-width: 100%;
            height: auto;
            object-fit: cover;
        }
        .empty-img-placeholder {
            background-color: #f8f9fc;
            border: 2px dashed #d1d3e2;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            color: #858796;
            margin-bottom: 15px;
        }
    </style>

    <section class="content-header mx-3 mt-3">
        <div class="container-fluid">
            <div class="row mb-3 align-items-center">
                <div class="col-sm-8">
                    <h1 class="page-header"><i class="fas fa-edit mr-2" style="color: #667eea;"></i> Ubah Artikel</h1>
                    <p class="text-muted mb-0">Perbarui konten atau gambar sampul artikel di bawah ini.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content mx-3 mb-5">
        <div class="row">
            <div class="col-lg-10 col-md-12">
                <div class="card modern-card">
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('artikel.update', $artikel->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <!-- Input Judul Artikel -->
                            <div class="form-group mb-4">
                                <label for="judul" class="form-label">Judul Artikel</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-custom has-icon @error('judul') is-invalid @enderror" name="judul" id="judul" value="{{ old('judul', $artikel->judul) }}">
                                    
                                    @error('judul')
                                        <div class="invalid-feedback d-block mt-2">
                                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Gambar Artikel -->
                            <div class="form-group mb-4">
                                <label for="gambar" class="form-label"><i class="fas fa-image mr-1" style="color: #667eea;"></i> Gambar Sampul Artikel</label>
                                
                                <!-- Area Preview Gambar -->
                                <div>
                                    @if (empty($artikel->gambar))
                                        <div class="empty-img-placeholder">
                                            <i class="fas fa-image fa-2x mb-2 text-gray-300"></i>
                                            <p class="mb-0">Tidak ada gambar sampul.</p>
                                        </div>
                                    @else
                                        <div class="img-preview-container">
                                            <img src="{{ Storage::url($artikel->gambar) }}" class="img-preview" width="300" alt="Preview Gambar Artikel">
                                        </div>
                                    @endif
                                </div>

                                <!-- Custom File Input -->
                                <div class="input-group mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-upload"></i></span>
                                    </div>
                                    <input type="file" name="gambar" id="gambar" class="form-control input-custom has-icon @error('gambar') is-invalid @enderror" style="padding-top: 9px;">
                                </div>
                                <small class="text-muted mt-2 d-block"><i class="fas fa-info-circle mr-1" style="color: #667eea;"></i> <em>Biarkan kosong jika Anda tidak ingin mengubah gambar saat ini.</em></small>
                                
                                @error('gambar')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Input Isi Artikel (TinyMCE) -->
                            <div class="form-group mb-4">
                                <label for="isi" class="form-label"><i class="fas fa-pen-nib mr-1" style="color: #667eea;"></i> Isi Artikel</label>
                                <textarea class="form-control tinymce @error('isi') is-invalid @enderror" name="isi" id="isi" rows="10">{{ old('isi', $artikel->isi) }}</textarea>
                                
                                @error('isi')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <hr class="my-4" style="border-color: #eaecf4;">

                            <!-- Tombol Aksi -->
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('artikel.index') }}" class="btn btn-cancel-modern mr-2">
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