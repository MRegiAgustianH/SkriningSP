@extends('template.app')

@section('content')
    <section class="about_section layout_margin-bottom">
        <div class="container">
            <div class="row align-items-start mt-4">
                <div class="col-md-5">
                    <div class="img-box">
                        <img src="{{ Storage::url($profil->foto) }}" alt="Profil Image">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="detail-box">
                        <div class="heading_container">
                            <h2>
                                Tentang
                            </h2>
                        </div>
                        {!! Str::words($profil->profil, 50, '') !!}
                        <p>
                            <a href="{{ route('about') }}">
                                Selengkapnya
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
