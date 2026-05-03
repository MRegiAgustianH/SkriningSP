<?php

namespace App\Http\Controllers;

use App\Rules\Passlama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('auth.password');
    }

    public function proses(Request $request)
    {
        $messages = [
            'required' => ':attribute harus diisi',
            'confirmed' => ':attribute harus sama',
        ];

        $this->validate($request, [
            'password_lama' => ['required', new Passlama],
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ], $messages);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with(['success' => 'Password berhasil diubah']);
    }
}
