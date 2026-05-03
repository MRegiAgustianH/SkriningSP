<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Storage;

class ProfilController extends Controller
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
        $profil = Profil::take(1)->first();
        if (empty($profil)) {
            return view('profil.create');
        } else {
            return view('profil.edit', compact('profil'));
        }
    }

    public function store(Request $request)
    {
        $message = [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah ada',
        ];

        $validated = $request->validate([
            'profil' => 'required',
        ], $message);

        if ($request->file('foto')) {
            $validated['foto'] = $request->file('foto')->store('public/files');
        } else {
            $validated['foto'] = '';
        }

        $result = Profil::create($validated);

        if ($result) {
            return redirect()->route('profil.index')->with(['success' => 'Data berhasil disimpan']);
        } else {
            return redirect()->route('profil.index')->with(['error' => 'Data gagal disimpan']);
        }
    }

    public function update(Request $request, Profil $profil)
    {
        $message = [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah ada',
        ];

        $validated = $request->validate([
            'profil' => 'required',
        ], $message);

        $foto = $profil->foto;
        if ($request->file('foto')) {
            Storage::delete($foto);
            $validated['foto'] = $request->file('foto')->store('public/files');
        } else {
            $validated['foto'] = $foto;
        }

        $result = $profil->update($validated);

        if ($result) {
            return redirect()->route('profil.index')->with(['success' => 'Data berhasil diubah']);
        } else {
            return redirect()->route('profil.index')->with(['error' => 'Data gagal diubah']);
        }
    }
}
