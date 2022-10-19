<?php

namespace App\Http\Controllers;

use App\Models\Games;
use Illuminate\Http\Request;
use App\Http\Controllers\TripayController;
use App\Models\Kategori;

class GamesController extends Controller
{
    public function index()
    {

        return view('games', [
            'title' => 'Games',
            'kategori' => Kategori::all()
        ]);
    }

    public function show(Games $id_game)
    {
        // get channels
        $tripay = new TripayController;
        $channels = $tripay->getPaymentChannels();

        return view('game', [
            'title' => 'Game',
            'game' => $id_game,
            'channels' => $channels
        ]);
    }
}
