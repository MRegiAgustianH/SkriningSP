<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;

class GejalaController extends Controller
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
        $gejala = Gejala::all();
        return view('gejala.index', compact('gejala'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gejala.create');
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
            'kode_gejala' => 'required|unique:gejala',
            'nama_gejala' => 'required',
        ], $message);

        $result = Gejala::create($validated);

        if ($result) {
            return redirect()->route('gejala.index')->with(['success' => 'Data berhasil disimpan']);
        } else {
            return redirect()->route('gejala.index')->with(['error' => 'Data gagal disimpan']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Gejala $gejala)
    {
        return view('gejala.edit', compact('gejala'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gejala $gejala)
    {
        $message = [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah digunakan',
        ];

        $validated = $request->validate([
            'kode_gejala' => 'required|unique:gejala,kode_gejala,' . $gejala->id,
            'nama_gejala' => 'required',
        ], $message);

        $result = $gejala->update($validated);

        if ($result) {
            return redirect()->route('gejala.index')->with(['success' => 'Data berhasil diubah']);
        } else {
            return redirect()->route('gejala.index')->with(['error' => 'Data gagal diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gejala $gejala)
    {
        $result = $gejala->delete();

        if ($result) {
            return redirect()->route('gejala.index')->with(['success' => 'Data berhasil dihapus']);
        } else {
            return redirect()->route('gejala.index')->with(['error' => 'Data gagal dihapus']);
        }
    }
}
