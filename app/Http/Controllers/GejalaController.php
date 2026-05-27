<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GejalaController extends Controller
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
        $gejala = Gejala::all();
        return view('gejala.index', compact('gejala'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gejala.create');
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
            'kode_gejala' => 'required|unique:gejala',
            'nama_gejala' => 'required',
            'animasi' => 'nullable|file|mimes:gif,png,jpg,jpeg,webp|max:5120',
        ], $message);

        // Upload file animasi jika ada
        if ($request->hasFile('animasi')) {
            $validated['animasi'] = $request->file('animasi')->store('public/animasi');
        }

        $result = Gejala::create($validated);

        if ($result) {
            return redirect()->route('gejala.index')->with(['success' => 'Data berhasil disimpan']);
        } else {
            return redirect()->route('gejala.index')->with(['error' => 'Data gagal disimpan']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gejala $gejala)
    {
        return view('gejala.edit', compact('gejala'));
    }

    /**
     * Update the specified resource in storage.
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
            'animasi' => 'nullable|file|mimes:gif,png,jpg,jpeg,webp|max:5120',
        ], $message);

        // Upload file animasi baru jika ada
        if ($request->hasFile('animasi')) {
            // Hapus file lama jika ada
            if ($gejala->animasi) {
                Storage::delete($gejala->animasi);
            }
            $validated['animasi'] = $request->file('animasi')->store('public/animasi');
        }

        // Hapus animasi jika checkbox hapus dicentang
        if ($request->has('hapus_animasi')) {
            if ($gejala->animasi) {
                Storage::delete($gejala->animasi);
            }
            $validated['animasi'] = null;
        }

        $result = $gejala->update($validated);

        if ($result) {
            return redirect()->route('gejala.index')->with(['success' => 'Data berhasil diubah']);
        } else {
            return redirect()->route('gejala.index')->with(['error' => 'Data gagal diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gejala $gejala)
    {
        // Hapus file animasi jika ada
        if ($gejala->animasi) {
            Storage::delete($gejala->animasi);
        }

        $result = $gejala->delete();

        if ($result) {
            return redirect()->route('gejala.index')->with(['success' => 'Data berhasil dihapus']);
        } else {
            return redirect()->route('gejala.index')->with(['error' => 'Data gagal dihapus']);
        }
    }
}
