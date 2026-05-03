@extends('template.app2')

@section('content')
    <section class="about_section layout_margin-bottom layout_margin-top">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-md-12">
                    <div class="detail-box">
                        <div class="heading_container heading_center">
                            <h2>
                                {{ $artikel->judul }}
                            </h2>
                        </div>
                        <p class="text-center mb-4 text-muted"><small>Diterbitkan tanggal <strong>{{ date('d/m/Y', strtotime($artikel->created_at)) }}</strong> oleh <strong>{{ $artikel->user->name }}</strong></small></p>
                        <div class="img-box col-sm-8 m-auto">
                            <img src="{{ Storage::url($artikel->gambar) }}" alt="Gambar Artikel">
                        </div>
                        {!! $artikel->isi !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
