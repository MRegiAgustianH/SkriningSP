<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Aturan;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Profil;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $aturan = Aturan::select('*')
                ->groupBy('penyakit_id')
                ->get();
            $aturan = Aturan::all();
            $gejala = Gejala::all();
            $penyakit = Penyakit::all();
            $pengguna = User::all();

            return view('home_backend', compact('aturan', 'gejala', 'penyakit', 'pengguna'));
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
