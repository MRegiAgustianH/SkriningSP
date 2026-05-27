<?php

namespace App\Http\Controllers;

use App\Models\Kecanduan;
use Illuminate\Http\Request;

class KecanduanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kecanduan = Kecanduan::all();
        return view('kecanduan.index', compact('kecanduan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kecanduan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah digunakan',
        ];

        $validated = $request->validate([
            'kode_kecanduan' => 'required|unique:tingkat_kecanduan',
            'nama_kecanduan' => 'required',
            'solusi' => 'required',
        ], $message);

        $validated['deskripsi'] = $request->deskripsi;

        $result = Kecanduan::create($validated);

        if ($result) {
            return redirect()->route('kecanduan.index')->with(['success' => 'Data berhasil disimpan']);
        } else {
            return redirect()->route('kecanduan.index')->with(['error' => 'Data gagal disimpan']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kecanduan $kecanduan)
    {
        return view('kecanduan.edit', compact('kecanduan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kecanduan $kecanduan)
    {
        $message = [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah digunakan',
        ];

        $validated = $request->validate([
            'kode_kecanduan' => 'required|unique:tingkat_kecanduan,kode_kecanduan,' . $kecanduan->id,
            'nama_kecanduan' => 'required',
            'solusi' => 'required',
        ], $message);

        $validated['deskripsi'] = $request->deskripsi;

        $result = $kecanduan->update($validated);

        if ($result) {
            return redirect()->route('kecanduan.index')->with(['success' => 'Data berhasil diubah']);
        } else {
            return redirect()->route('kecanduan.index')->with(['error' => 'Data gagal diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kecanduan $kecanduan)
    {
        $result = $kecanduan->delete();

        if ($result) {
            return redirect()->route('kecanduan.index')->with(['success' => 'Data berhasil dihapus']);
        } else {
            return redirect()->route('kecanduan.index')->with(['error' => 'Data gagal dihapus']);
        }
    }
}
