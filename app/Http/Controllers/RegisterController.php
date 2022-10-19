<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {

        return view('akses.register', [

            'title' => 'Register'
        ]);
    }

    public function store(Request $request)
    {
        // validasi request
        $validateData =  $request->validate([

            'name' => 'required|max:100',
            'email' => 'required|max:100|unique:users|email:dns',
            'password' => 'required|min:4'
        ]);

        // hash password
        $validateData['password'] = Hash::make($validateData['password']);
        $validateData['name'] = ucwords($validateData['name']);

        // simpan di db
        User::create($validateData);

        return back()->with('registerSucces', 'Berhasil..!!');
    }
}
