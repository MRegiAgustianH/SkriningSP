@extends('template_backend.app')

@section('content')
    <section class="content-header mx-3">
        <div class="container-fluid">
            <div class="row mb-1">
                <h1>Ubah Data Tentang</h1>
            </div>
        </div>
    </section>

    <section class="content mx-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10">
                        <form action="{{ route('profil.update', $profil->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="profil">Profil</label>
                                <textarea class="form-control tinymce @error('profil') is-invalid @enderror" name="profil" id="profil" rows="6">{{ old('profil', $profil->profil) }}</textarea>
                                <div class="invalid-feedback">
                                    @error('profil')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                @if (empty($profil->foto))
                                    <p>Tidak ada foto</p>
                                @else
                                    <p><img src="{{ Storage::url($profil->foto) }}" class="img-thumbnail" width="250"></p>
                                @endif
                                <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror">
                                <small>*Kosongkan jika foto tidak diubah</small>
                                <div class="invalid-feedback">
                                    @error('foto')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
