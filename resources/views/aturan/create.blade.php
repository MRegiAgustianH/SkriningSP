@extends('template_backend.app')

@section('content')
    <style>
        /* --- CUSTOM MODERN STYLE UNTUK FORM ATURAN --- */
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
            border-top: 4px solid #f6c23e; /* Aksen kuning/warning untuk Aturan */
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
            border-color: #f6c23e; /* Fokus warna kuning */
            box-shadow: 0 0 0 0.2rem rgba(246, 194, 62, 0.25);
        }
        
        /* Styling untuk Icon di dalam Input */
        .input-group-text {
            border-radius: 10px 0 0 10px;
            border: 1px solid #e2e8f0;
            background-color: #f8f9fc;
            color: #f6c23e; /* Icon warna kuning */
            border-right: none;
        }
        .input-custom.has-icon {
            border-radius: 0 10px 10px 0;
            border-left: none;
        }

        /* Styling Custom untuk Select2 agar menyatu dengan tema */
        .select2-container--default .select2-selection--single {
            border-radius: 0 10px 10px 0 !important;
            border: 1px solid #e2e8f0 !important;
            height: 48px !important;
            display: flex;
            align-items: center;
        }
        .select2-container--default .select2-selection--single:focus,
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #f6c23e !important;
            box-shadow: 0 0 0 0.2rem rgba(246, 194, 62, 0.25) !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding-left: 15px !important;
            color: #4a5568 !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 46px !important;
            right: 10px !important;
        }
        
        /* Tombol Simpan & Batal */
        .btn-save-modern {
            background: linear-gradient(135deg, #1cc88a 0%, #13a673 100%); /* Tombol simpan tetap hijau (sukses) */
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
    </style>

    <section class="content-header mx-3 mt-3">
        <div class="container-fluid">
            <div class="row mb-3 align-items-center">
                <div class="col-sm-8">
                    <h1 class="page-header"><i class="fas fa-plus-circle text-warning mr-2"></i> Tambah Data Aturan</h1>
                    <p class="text-muted mb-0">Atur relasi antara tingkat kecanduan, gejala, dan nilai kepastian (CF Pakar).</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content mx-3 mb-5">
        <div class="row">
            <div class="col-lg-8 col-md-10">
                <div class="card modern-card">
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('aturan.store') }}" method="post">
                            @csrf
                            
                            <!-- Input Pilih Kecanduan -->
                            <div class="form-group mb-4">
                                <label for="kecanduan_id" class="form-label">Tingkat Kecanduan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-book-medical"></i></span>
                                    </div>
                                    <select name="kecanduan_id" id="kecanduan_id" class="form-control select2 @error('kecanduan_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Tingkat Kecanduan --</option>
                                        @foreach ($kecanduan as $row)
                                            <option value="{{ $row->id }}" {{ old('kecanduan_id') == $row->id ? 'selected' : '' }}>
                                                {{ $row->kode_kecanduan . ' - ' . $row->nama_kecanduan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                    @error('kecanduan_id')
                                        <div class="invalid-feedback d-block mt-2">
                                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Pilih Gejala -->
                            <div class="form-group mb-4">
                                <label for="gejala_id" class="form-label">Gejala yang Dialami</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-stethoscope"></i></span>
                                    </div>
                                    <select name="gejala_id" id="gejala_id" class="form-control select2 @error('gejala_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Gejala Terkait --</option>
                                        @foreach ($gejala as $row)
                                            <option value="{{ $row->id }}" {{ old('gejala_id') == $row->id ? 'selected' : '' }}>
                                                {{ $row->kode_gejala . ' - ' . $row->nama_gejala }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                    @error('gejala_id')
                                        <div class="invalid-feedback d-block mt-2">
                                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input CF Pakar -->
                            <div class="form-group mb-4">
                                <label for="cf_pakar" class="form-label">Nilai CF Pakar</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-percentage"></i></span>
                                    </div>
                                    <input type="number" step="0.1" class="form-control input-custom has-icon @error('cf_pakar') is-invalid @enderror" name="cf_pakar" id="cf_pakar" value="{{ old('cf_pakar') }}" placeholder="Contoh: 0.8" required>
                                </div>
                                <small class="text-muted mt-2 d-block"><i class="fas fa-info-circle text-info mr-1"></i> Masukkan nilai dari <strong>0.1</strong> sampai <strong>1.0</strong> (Contoh: 0.8 untuk Sangat Yakin).</small>
                                
                                @error('cf_pakar')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <hr class="my-4" style="border-color: #eaecf4;">

                            <!-- Tombol Aksi -->
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('aturan.index') }}" class="btn btn-cancel-modern mr-2">
                                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-save-modern">
                                    <i class="fas fa-save mr-1"></i> Simpan Relasi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection