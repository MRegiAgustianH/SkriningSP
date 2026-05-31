@extends('template.app2')

@section('content')
    <section class="department_section mb-4 layout_margin-top">
        <div class="department_container">
            <div class="container ">
                <div class="heading_container heading_center">
                    <!-- <h2>
                        Diagnosa
                    </h2>
                    <p class="text-muted">Isi data diri Pasien</p> -->
                </div>
            </div>
        </div>
    </section>

    <section class="about_section layout_margin-bottom content mx-3 p-4">
    <div class="card">
      
        <div class="container" align="center">
                    <h1 align="center">
                        Diagnosa
                    </h1>
                    <p align="center" class="text-muted">Isi data diri Pengunjung</p>
<hr>
                <div class="col-sm-8 m-auto" align="center">
                    <form action="{{ route('diagnosis.proses') }}" method="post">
                        @csrf

                        <!-- <div class="row"> -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" required class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama') }}">
                                    <div class="invalid-feedback">
                                        @error('nama')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select required class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="jenis_kelamin">
                                        <option value="">Pilih</option>
                                        <option value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('jenis_kelamin')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_hp">No HP</label>
                                    <input type="tel" minlength="12" maxlength="13" required class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" id="no_hp" value="{{ old('no_hp') }}">
                                    <div class="invalid-feedback">
                                        @error('no_hp')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mx 3">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" required class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" value="{{ old('alamat') }}">
                                    <div class="invalid-feedback">
                                        @error('alamat')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row justify-content-center mb-5">
                            <div class="col-md-4">
                                <button type="submit" id="btnMulaiSkrining" name="btn_proses" class="btn btn-lg btn-block btn-primary" style="border-radius: 30px; box-shadow: 0 4px 15px rgba(3, 131, 239, 0.3); font-weight: bold; transition: all 0.3s ease;"><i class="fa fa-arrow-right mr-2"></i> Mulai Skrining</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Glassmorphic Premium Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay" style="display: none;">
        <div class="loading-content">
            <div class="loader-circle-wrapper">
                <div class="loader-circle"></div>
                <div class="loader-circle-inner"></div>
                <i class="fa fa-gamepad loader-icon"></i>
            </div>
            <h2 class="loading-title">Mulai Skrining</h2>
            <div class="loading-bar-container">
                <div class="loading-bar-fill"></div>
            </div>
            <p class="loading-subtitle">Menganalisis data diri...</p>
        </div>
    </div>

    <!-- Isolated CSS Styles for Loading Overlay -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(15, 23, 42, 0.88);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            z-index: 99999;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-family: 'Poppins', 'Roboto', sans-serif;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .loading-overlay.active {
            opacity: 1;
            display: flex !important;
        }

        .loading-content {
            text-align: center;
            max-width: 450px;
            padding: 30px;
            width: 90%;
        }

        .loader-circle-wrapper {
            position: relative;
            width: 130px;
            height: 130px;
            margin: 0 auto 35px auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader-circle {
            position: absolute;
            width: 100%;
            height: 100%;
            border: 4px solid transparent;
            border-top-color: #0383ef;
            border-bottom-color: #00c6ff;
            border-radius: 50%;
            animation: spin 1.5s linear infinite;
        }

        .loader-circle-inner {
            position: absolute;
            width: 80%;
            height: 80%;
            border: 3.5px solid transparent;
            border-left-color: #10b981;
            border-right-color: #f59e0b;
            border-radius: 50%;
            animation: spin-reverse 1.2s linear infinite;
        }

        .loader-icon {
            font-size: 45px;
            color: #fff;
            animation: pulse-icon 1.5s ease-in-out infinite;
            text-shadow: 0 0 15px rgba(3, 131, 239, 0.7);
        }

        .loading-title {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 12px;
            background: linear-gradient(135deg, #38bdf8, #0383ef);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: pulse-text 2s infinite;
        }

        .loading-bar-container {
            width: 100%;
            height: 6px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 18px;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.2);
        }

        .loading-bar-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #0383ef, #00c6ff, #10b981);
            border-radius: 10px;
        }

        .loading-subtitle {
            font-size: 15px;
            color: #94a3b8;
            min-height: 22px;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        /* Hover effects on submit button */
        #btnMulaiSkrining:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(3, 131, 239, 0.45);
            background-color: #026ebd !important;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes spin-reverse {
            0% { transform: rotate(360deg); }
            100% { transform: rotate(0deg); }
        }

        @keyframes pulse-icon {
            0%, 100% { transform: scale(1); opacity: 0.85; }
            50% { transform: scale(1.15); opacity: 1; filter: drop-shadow(0 0 15px rgba(3, 131, 239, 0.9)); }
        }

        @keyframes pulse-text {
            0%, 100% { opacity: 0.9; }
            50% { opacity: 1; }
        }
    </style>
@endsection

@section('js')
    <script>
        $(function() {
            $('form').submit(function(e) {
                e.preventDefault();
                var form = this;

                // Validate form first
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                // Show Loading Overlay with fade-in effect
                var $overlay = $('#loadingOverlay');
                $overlay.css('display', 'flex');
                setTimeout(function() {
                    $overlay.addClass('active');
                }, 10);

                // Animate progress bar fill smoothly
                $('.loading-bar-fill').animate({
                    width: '100%'
                }, 2400, 'linear');

                // Dynamic loading text subtitles
                var subtitles = [
                    "Menganalisis data diri...",
                    "Menyiapkan instrumen skrining...",
                    "Menginisialisasi model diagnosis...",
                    "Hampir selesai, selamat datang!"
                ];
                var currentSub = 0;
                var interval = setInterval(function() {
                    if (currentSub < subtitles.length - 1) {
                        currentSub++;
                        $('.loading-subtitle').fadeOut(200, function() {
                            $(this).text(subtitles[currentSub]).fadeIn(200);
                        });
                    }
                }, 600);

                // Delay submission for a high-fidelity loading experience
                setTimeout(function() {
                    clearInterval(interval);
                    form.submit();
                }, 2500);
            });
        });
    </script>
@endsection

