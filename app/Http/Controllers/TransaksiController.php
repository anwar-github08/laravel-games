<?php

namespace App\Http\Controllers;

use App\Models\Games;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TripayController;
use Illuminate\Support\Facades\Redirect;

class TransaksiController extends Controller
{

    public function show($reference)
    {
        $tripay = new TripayController;
        $detailTransaksi = $tripay->detailTransaksi($reference);


        // return view('transaksi.transaksi', [
        //     'data' => $detailTransaksi
        // ]);

        // dd($detailTransaksi);

        // return redirect()->away($detailTransaksi->checkout_url);
        return Redirect::away($detailTransaksi->checkout_url);
    }


    public function store(Request $request)
    {

        // Request transaksi ke tripay
        $method = $request->method;
        $game =  Games::find($request->game_id);

        // jika ada login
        if (auth()->guard()->check()) {

            $user_id = auth()->user()->id;
            $email = auth()->user()->email;
        } else {

            $user_id = 1;
            $email = $request->email;
        }

        $tripay = new TripayController;
        $transaksi = $tripay->requestTransaksi($method, $game, $email);


        // Simpan transaksi ke db
        Transaksi::create([
            'user_id' => $user_id,
            'email' => $email,
            'game_id' => $request->game_id,
            'reference' => $transaksi->reference,
            'merchant_ref' => $transaksi->merchant_ref,
            'channel' => $transaksi->payment_name,
            'amount' => $transaksi->amount,
            'status' => $transaksi->status
        ]);

        return redirect()->route('transaksi.show', parameters: [
            'reference' => $transaksi->reference
        ]);
    }
}
