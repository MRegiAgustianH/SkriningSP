<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use Auth;
use App;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $hasil = Hasil::latest()->get();
        return view('hasil.index', compact('hasil'));
      
        
    }

    public function show(Hasil $hasil)
    {

        return view('hasil.show', compact('hasil'));
    }

    public function update(Hasil $hasil)
    {
        return view('hasil.edit', compact('hasil'));
    }
    public function edit(Hasil $hasil)
    {
        return view('hasil.edit', compact('hasil'));
    }

    public function destroy(Hasil $hasil)
    {
        $result = $hasil->delete();

        if ($result) {
            return redirect()->route('hasil.index')->with(['success' => 'Data berhasil dihapus']);
        } else {
            return redirect()->route('hasil.index')->with(['error' => 'Data gagal dihapus']);
        }
    }

    public function cetak(Hasil $hasil)
    {
        $pdf = App::make('dompdf.wrapper');
        $html = view('hasil.cetak', compact('hasil'));
        $pdf->loadHTML($html);
        return $pdf->stream();
    }
}
