<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Transaksi extends Component
{
    public $pulsa = false;
    public $pln = false;
    public $mobileLegend = false;

    public $kategori;
    public $kode_produk;
    public $nama_produk;
    public $harga;

    public function render()
    {
        return view('livewire.transaksi');
    }

    // listeners untuk menangkap emit
    public function getListeners()
    {
        return [

            // emit dari show-produk
            'eBeli'

        ];
    }

    // menjalankan emit beli
    public function eBeli($kategori, $kode_produk, $nama_produk, $harga)
    {
        $this->kategori = $kategori;
        $this->kode_produk = $kode_produk;
        $this->nama_produk = $nama_produk;
        $this->harga = $harga;

        if ($kategori == 'Pulsa') {
            $this->pulsa = true;

            // untuk kirim data kategori dan kode produk ke komponen pulsa
            $this->emit('eBeliPulsa', $this->kategori, $this->kode_produk, $this->nama_produk, $this->harga);
        }

        if ($kategori == 'PLN') {
            $this->pln = true;

            // untuk kirim data kategori dan kode produk ke komponen pln
            $this->emit('eBeliPln', $this->kategori, $this->kode_produk);
        }
    }


    // fungsi untuk kembali ke komponen sebelumnya atau ke komponen show-produk
    public function back()
    {
        $this->emit('eBack', $this->kategori);
        $this->pulsa = false;
    }
}
