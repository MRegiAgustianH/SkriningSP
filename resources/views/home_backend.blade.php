@extends('template_backend.app')

@section('content')
    <style>
        /* Custom CSS untuk Tampilan Clean & Modern */
        .welcome-banner {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            border-radius: 15px;
            color: white;
            padding: 25px 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .welcome-banner h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .welcome-banner p {
            margin-bottom: 0;
            opacity: 0.9;
        }
        .stat-card {
            background: #ffffff;
            border-radius: 15px;
            padding: 20px;
            border: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.04);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        }
        .stat-title {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #858796;
            margin-bottom: 10px;
            z-index: 2;
        }
        .stat-value {
            font-size: 2.2rem;
            font-weight: 800;
            color: #3a3b45;
            margin-bottom: 0;
            z-index: 2;
        }
        .stat-icon {
            position: absolute;
            right: -10px;
            bottom: -15px;
            font-size: 6rem;
            opacity: 0.08;
            z-index: 1;
            transition: all 0.3s ease;
        }
        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(-5deg);
            opacity: 0.15;
        }
        .stat-footer {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #f8f9fc;
            z-index: 2;
        }
        .stat-footer a {
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: color 0.2s ease;
        }
        .banner-logo-wrapper {
            background: #ffffff;
            padding: 15px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.04);
            margin-top: 20px;
            margin-bottom: 30px;
        }
        .banner-logo-wrapper img {
            border-radius: 10px;
            width: 100%;
            object-fit: cover;
        }
        
        /* Warna Aksen Spesifik */
        .icon-primary { color: #4e73df; }
        .icon-success { color: #1cc88a; }
        .icon-warning { color: #f6c23e; }
        .icon-danger { color: #e74a3b; }
        .link-primary { color: #4e73df; }
        .link-success { color: #1cc88a; }
        .link-warning { color: #f6c23e; }
        .link-danger { color: #e74a3b; }
    </style>

    <section class="content-header mx-3 mt-3">
        <div class="container-fluid">
            <!-- Banner Selamat Datang -->
            <div class="welcome-banner">
                <h1>Dashboard SkriningApp</h1>
                <p>Sistem Pakar Analisis Tingkat Kecanduan Game Online</p>
            </div>
        </div>
    </section>

    <section class="content mx-3">
        <div class="row">
            <!-- Card Total Gejala -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card border-left-primary">
                    <div>
                        <div class="stat-title">Total Gejala</div>
                        <div class="stat-value">{{ count($gejala) }}</div>
                    </div>
                    <i class="fas fa-book stat-icon icon-primary"></i>
                    
                    @if (auth()->user()->role_id == 1)
                    <div class="stat-footer">
                        <a href="{{ route('gejala.index') }}" class="link-primary">
                            <span>Lihat detail</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Card Total Jenis Kecanduan -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card border-left-success">
                    <div>
                        <div class="stat-title">Tingkat Kecanduan</div>
                        <div class="stat-value">{{ count($kecanduan) }}</div>
                    </div>
                    <i class="fas fa-book-medical stat-icon icon-success"></i>
                    
                    @if (auth()->user()->role_id == 1)
                    <div class="stat-footer">
                        <a href="{{ route('kecanduan.index') }}" class="link-success">
                            <span>Lihat detail</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Card Total Aturan -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card border-left-warning">
                    <div>
                        <div class="stat-title">Total Aturan</div>
                        <div class="stat-value">{{ count($aturan) }}</div>
                    </div>
                    <i class="fas fa-cogs stat-icon icon-warning"></i>
                    
                    @if (auth()->user()->role_id == 1)
                    <div class="stat-footer">
                        <a href="{{ route('aturan.index') }}" class="link-warning">
                            <span>Lihat detail</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Card Total Pengguna -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card border-left-danger">
                    <div>
                        <div class="stat-title">Total Pengguna</div>
                        <div class="stat-value">{{ count($pengguna) }}</div>
                    </div>
                    <i class="fas fa-users stat-icon icon-danger"></i>
                    
                    @if (auth()->user()->role_id == 1)
                    <div class="stat-footer">
                        <a href="{{ route('pengguna.index') }}" class="link-danger">
                            <span>Lihat detail</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Banner Logo Bawah -->
        <div class="row">
            <div class="col-12">
                <div class="banner-logo-wrapper text-center">
                    <img src="{{ asset('assets/images/SkriningApp.png') }}" alt="Logo SkriningApp">
                </div>
            </div>
        </div>
    </section>
@endsection