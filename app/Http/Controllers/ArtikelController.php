<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Auth;
use Illuminate\Http\Request;
use Storage;

class ArtikelController extends Controller
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
        $artikel = Artikel::all();
        return view('artikel.index', compact('artikel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('artikel.create');
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
            'unique' => ':attribute sudah ada',
        ];

        $validated = $request->validate([
            'judul' => 'required',
            'gambar' => 'required',
            'isi' => 'required',
        ], $message);

        $validated['gambar'] = $request->file('gambar')->store('public/files');
        $validated['user_id'] = Auth::user()->id;

        $result = Artikel::create($validated);

        if ($result) {
            return redirect()->route('artikel.index')->with(['success' => 'Data berhasil disimpan']);
        } else {
            return redirect()->route('artikel.index')->with(['error' => 'Data gagal disimpan']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Artikel $artikel)
    {
        return view('artikel.edit', compact('artikel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artikel $artikel)
    {
        $message = [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah ada',
        ];

        $validated = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
        ], $message);

        $gambar = $artikel->gambar;
        if ($request->file('gambar')) {
            Storage::delete($gambar);
            $validated['gambar'] = $request->file('gambar')->store('public/files');
        } else {
            $validated['gambar'] = $gambar;
        }

        $result = $artikel->update($validated);

        if ($result) {
            return redirect()->route('artikel.index')->with(['success' => 'Data berhasil diubah']);
        } else {
            return redirect()->route('artikel.index')->with(['error' => 'Data gagal diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artikel $artikel)
    {
        Storage::delete($artikel->gambar);
        $result = $artikel->delete();

        if ($result) {
            return redirect()->route('artikel.index')->with(['success' => 'Data berhasil dihapus']);
        } else {
            return redirect()->route('artikel.index')->with(['error' => 'Data gagal dihapus']);
        }
    }
}
