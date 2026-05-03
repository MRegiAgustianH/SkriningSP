<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class PenggunaController extends Controller
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
        $pengguna = User::all();
        return view('pengguna.index', compact('pengguna'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('pengguna.create', compact('roles'));
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
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'role_id' => 'required',
        ], $message);

        $validated['password'] = Hash::make($request->password);

        $user = User::create($validated);

        if ($user) {
            return redirect()->route('pengguna.index')->with(['success' => 'Data berhasil disimpan']);
        } else {
            return redirect()->route('pengguna.index')->with(['error' => 'Data gagal disimpan']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $pengguna)
    {
        $roles = Role::all();
        return view('pengguna.edit', compact('pengguna', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $pengguna)
    {
        $message = [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah digunakan',
        ];

        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $pengguna->id,
            'role_id' => 'required',
        ], $message);

        $user = $pengguna->update($validated);

        if ($user) {
            return redirect()->route('pengguna.index')->with(['success' => 'Data berhasil diubah']);
        } else {
            return redirect()->route('pengguna.index')->with(['error' => 'Data gagal diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $pengguna)
    {
        $result = $pengguna->delete();

        if ($result) {
            return redirect()->route('pengguna.index')->with(['success' => 'Data berhasil dihapus']);
        } else {
            return redirect()->route('pengguna.index')->with(['error' => 'Data gagal dihapus']);
        }
    }
}
