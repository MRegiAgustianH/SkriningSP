@extends('template.app2')

@section('content')
    <section class="department_section layout_margin-bottom layout_margin-top">
        <div class="department_container">
            <div class="container ">
                <div class="heading_container heading_center">
                    <h2>
                        Artikel
                    </h2>
                </div>
            </div>
        </div>
    </section>

    @foreach ($artikel as $row)
        <section class="about_section layout_margin-bottom">
            <div class="container">
                <div class="row align-items-start">
                    <div class="col-md-4">
                        <div class="img-box">
                            <img src="{{ Storage::url($row->gambar) }}" alt="Gambar Artikel">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="detail-box">
                            <div class="heading_container">
                                <h2>
                                    {{ $row->judul }}
                                </h2>
                            </div>
                            {!! Str::words($row->isi, 20) !!}
                            <p>
                                <a href="{{ route('artikel_pengunjung.detail', $row->id) }}" class="btn-sm">
                                    Selengkapnya
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endsection
