<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Http\Controllers\DigiflazzController;

class ShowProduk extends Component
{
    public $kategori;
    public $produks;
    public $brands;
    public $produkBrands;

    public $brandSelect;

    public $changeBrand = false;

    // listeners untuk menangkap emit
    public function getListeners()
    {
        return [
            // emit dari transaksi
            'eBack'

        ];
    }
    public function eBack($kategori)
    {

        $this->kategori = $kategori;
    }
    public function mount(Request $kategori)
    {
        $this->kategori = $kategori->kategori;

        // get produk sesuai kategori
        $digiflazz = new DigiflazzController;
        $this->produks = $digiflazz->daftarHarga($this->kategori);

        // ambil brand yang duplicate atau ambil nama brand saja
        foreach ($this->produks as $key) {
            $this->brands[] = $key->brand;
        }
        $this->brands = array_unique($this->brands);

        // isi brandSelect dengan array pertama
        $this->brandSelect = array_values($this->brands)[0];

        // get produk sesuai brand
        $this->produkBrands = array_filter($this->produks, fn ($item) =>
        $item->brand == $this->brandSelect);

        return view('produk', ['title' => $this->kategori]);
    }

    public function render()
    {
        return view('livewire.show-produk');
    }

    public function changeBrand($brand)
    {
        $this->brandSelect = $brand;

        // get produk sesuai brand
        $this->produkBrands = array_filter($this->produks, fn ($item) =>
        $item['brand'] == $brand);

        // change property changeBrand untuk mentrigger foreach tabel yang ada di komponen
        $this->changeBrand = true;
    }
}
