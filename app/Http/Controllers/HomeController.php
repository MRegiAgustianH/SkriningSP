<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Aturan;
use App\Models\Gejala;
use App\Models\Kecanduan;
use App\Models\Profil;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $aturan = Aturan::all();
            $gejala = Gejala::all();
            $kecanduan = Kecanduan::all();
            $pengguna = User::all();

            return view('home_backend', compact('aturan', 'gejala', 'kecanduan', 'pengguna'));
        } else {
            $profil = Profil::take(1)->first();
            return view('home', compact('profil'));
        }
    }

    public function about()
    {
        $profil = Profil::take(1)->first();
        return view('tentang', compact('profil'));
    }

    public function artikel()
    {
        $artikel = Artikel::latest()->get();
        return view('artikel', compact('artikel'));
    }

    public function artikel_detail(Artikel $artikel)
    {
        return view('artikel_detail', compact('artikel'));
    }
}
