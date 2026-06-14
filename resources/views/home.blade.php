@extends('template.app')

@section('content')
    <section class="about_section layout_margin-bottom">
        <div class="container">
            <div class="row align-items-start mt-4">
                <div class="col-md-5" data-aos="fade-right">
                    <div class="img-box floating-element">
                        <img src="{{ Storage::url($profil->foto) }}" alt="Profil Image" style="border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                    </div>
                </div>
                <div class="col-md-7" data-aos="fade-left" data-aos-delay="200">
                    <div class="detail-box">
                        <div class="heading_container">
                            <h2>
                                Tentang
                            </h2>
                        </div>
                        {!! Str::words($profil->profil, 50, '') !!}
                        <p class="mt-3">
                            <a href="{{ route('about') }}" class="btn btn-outline-primary" style="border-radius: 20px;">
                                Selengkapnya <i class="fa fa-arrow-right ml-2"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
