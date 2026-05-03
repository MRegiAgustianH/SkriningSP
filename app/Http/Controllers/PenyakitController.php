<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use Illuminate\Http\Request;

class PenyakitController extends Controller
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
        $penyakit = Penyakit::all();
        return view('penyakit.index', compact('penyakit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penyakit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah digunakan',
        ];

        $validated = $request->validate([
            'kode_penyakit' => 'required|unique:penyakit',
            'nama_penyakit' => 'required',
            'solusi' => 'required',
        ], $message);

        $validated['deskripsi'] = $request->deskripsi;

        $result = Penyakit::create($validated);

        if ($result) {
            return redirect()->route('penyakit.index')->with(['success' => 'Data berhasil disimpan']);
        } else {
            return redirect()->route('penyakit.index')->with(['error' => 'Data gagal disimpan']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Penyakit $penyakit)
    {
        return view('penyakit.edit', compact('penyakit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penyakit $penyakit)
    {
        $message = [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah digunakan',
        ];

        $validated = $request->validate([
            'kode_penyakit' => 'required|unique:penyakit,kode_penyakit,' . $penyakit->id,
            'nama_penyakit' => 'required',
            'solusi' => 'required',
        ], $message);

        $validated['deskripsi'] = $request->deskripsi;

        $result = $penyakit->update($validated);

        if ($result) {
            return redirect()->route('penyakit.index')->with(['success' => 'Data berhasil diubah']);
        } else {
            return redirect()->route('penyakit.index')->with(['error' => 'Data gagal diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penyakit $penyakit)
    {
        $result = $penyakit->delete();

        if ($result) {
            return redirect()->route('penyakit.index')->with(['success' => 'Data berhasil dihapus']);
        } else {
            return redirect()->route('penyakit.index')->with(['error' => 'Data gagal dihapus']);
        }
    }
}
