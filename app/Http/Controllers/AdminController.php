<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $this->authorize('admin');
        return view('admin.index', [
            'title' => 'Admin',
            'data' => Transaksi::with('game', 'user')->latest()->get()
        ]);
    }

    public function show(Request $request)
    {

        $ref_email = $request->ref_email;

        return view('admin.cekTransaksi', [
            'title' => 'Cek Transaksi',
            'data' => Transaksi::with('game')->where('email', $ref_email)->orWhere('reference', $ref_email)->get()
        ]);
    }


    public function riwayatTransaksi()
    {
        $email = auth()->user()->email;

        return view('admin.cekTransaksi', [
            'title' => 'Riwayat Transaksi',
            'data' => Transaksi::with('game')->where('email', $email)->get()
        ]);
    }
}
