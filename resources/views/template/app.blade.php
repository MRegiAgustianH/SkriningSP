<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title>Sistem Pakar Diagnosa Gejala Kecanduan Game Online</title>

    <link href="{{ asset('assets/frontend/css/bootstrap.css') }}" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet" />

    <link href="{{ asset('assets/frontend/css/font-awesome.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/frontend/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/frontend/css/responsive.css') }}" rel="stylesheet" />

    <link rel="shortcut icon" href="{{ asset('assets/images/logo-awal.png') }}" type="image/x-icon">
    
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<style>
     @font-face /*perintah untuk memanggil font eksternal*/
  {
    font-family: 'Gameplay'; /*memberikan nama bebas untuk font*/
    src: url('assets/gameplay/Gameplay.ttf');/*memanggil file font eksternalnya di folder nexa*/
  }
    .slider_section .detail-box h1 {
  font-size: 3rem;
  font-weight: normal;
  font-family: "Gameplay";
  text-transform: uppercase;
  margin-bottom: 15px;
  color: #ffffff;
}

/* Floating Animation */
@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
    100% { transform: translateY(0px); }
}
.floating-element {
    animation: float 4s ease-in-out infinite;
}
</style>

<body>

    <div class="hero_area">

        <div class="hero_bg_box">
            <img src="{{ asset('assets/frontend/images/hero-bg.png') }}" alt="">
        </div>

        <!-- header section strats -->
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="{{ route('home') }}" data-aos="fade-down">
                        <img src="{{ asset('assets/images/SkriningApp.png') }}" class="mr-2" alt="" width="200">
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""> </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">

                            @include('template.menu')

                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->
        <!-- slider section -->
        <section class="slider_section">
            <div id="customCarousel1" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container ">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="detail-box">
                                        <h1 data-aos="fade-up">
                                            Sistem Pakar Skrining Gejala Kecanduan Game Online
                                        </h1>
                                        <p data-aos="fade-up" data-aos-delay="200">
                                            Menggunakan Metode Certainty Factor
                                        </p>
                                        <div class="btn-box" data-aos="zoom-in" data-aos-delay="400">
                                            <a href="{{ route('diagnosis') }}" class="btn1" style = "font-color:#0383ef;">
                                                Mulai Skrining
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- end slider section -->
    </div>

    @yield('content')

    @include('template.footer')

    <script src="{{ asset('assets/frontend/js/jquery-3.4.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, // durasi animasi
            once: true, // animasi hanya diputar sekali saat scroll
            offset: 100 // jarak trigger
        });
    </script>

    @yield('js')
</body>

</html>
