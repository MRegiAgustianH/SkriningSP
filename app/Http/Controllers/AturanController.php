<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\Gejala;
use App\Models\Penyakit;
use Illuminate\Http\Request;

class AturanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aturan = Aturan::all();
        return view('aturan.index', compact('aturan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penyakit = Penyakit::all();
        $gejala = Gejala::all();
        return view('aturan.create', compact('penyakit', 'gejala'));
    }

    public function store(Request $request)
    {
        $message = [
            'required' => ':attribute harus diisi',
        ];

        $validated = $request->validate([
            'penyakit_id' => 'required',
            'gejala_id' => 'required',
            'cf_pakar' => 'required',
        ], $message);

        $result = Aturan::create([
            'penyakit_id' => $validated['penyakit_id'],
            'gejala_id' => $validated['gejala_id'],
            'cf_pakar' => $validated['cf_pakar'],
        ]);

        if ($result) {
            return redirect()->route('aturan.index')->with(['success' => 'Data berhasil disimpan']);
        } else {
            return redirect()->route('aturan.index')->with(['error' => 'Data gagal disimpan']);
        }
    }

    public function edit(Aturan $aturan)
    {
        $penyakit = Penyakit::all();
        $gejala = Gejala::all();

        return view('aturan.edit', compact('aturan', 'penyakit', 'gejala'));
    }

    public function update(Request $request, Aturan $aturan)
    {
        $message = [
            'required' => ':attribute harus diisi',
        ];

        $validated = $request->validate([
            'penyakit_id' => 'required',
            'gejala_id' => 'required',
            'cf_pakar' => 'required',
        ], $message);

        $result = $aturan->update($validated);

        if ($result) {
            return redirect()->route('aturan.index')->with(['success' => 'Data berhasil diubah']);
        } else {
            return redirect()->route('aturan.index')->with(['error' => 'Data gagal diubah']);
        }
    }

    public function destroy(Aturan $aturan)
    {
        $result = $aturan->delete();

        if ($result) {
            return redirect()->route('aturan.index')->with(['success' => 'Data berhasil dihapus']);
        } else {
            return redirect()->route('aturan.index')->with(['error' => 'Data gagal dihapus']);
        }
    }
}
