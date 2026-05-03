@extends('template.app2')

@section('content')
    <section class="about_section layout_padding">
        <div class="container">
            <div class="row align-items-start">
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
                        <hr>
                        {!! $profil->profil !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
