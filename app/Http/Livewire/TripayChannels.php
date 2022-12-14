<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\TripayController;

class TripayChannels extends Component
{

    public $channels;
    public $code;
    public $biaya;

    public $harga;
    public $no_telf;

    function mount($harga)
    {
        $this->harga = $harga;
        $tripay = new TripayController;
        $channels = $tripay->getPaymentChannels();
        $this->channels = $channels;
    }

    public function render()
    {
        $tripay = new TripayController;
        $channels = $tripay->getPaymentChannels();
        $this->channels = $channels;
        return view('livewire.tripay-channels');
    }

    public function storeBiaya($flat, $persen)
    {
        $tripay = new TripayController;
        $channels = $tripay->getPaymentChannels();
        $this->channels = $channels;

        $persen_harga = $persen / 100 * $this->harga;
        $harga_fix = $this->harga + $persen_harga + $flat;

        $this->biaya = 'Total : ' . number_format($harga_fix);
    }
}
