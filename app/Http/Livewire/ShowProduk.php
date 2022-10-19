<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Http\Controllers\DigiflazzController;

class ShowProduk extends Component
{
    public $kategori;
    public $allProduks;
    public $brands;
    public $produkBrands;

    public $brandSelect;

    public function mount(Request $kategori)
    {
        $this->kategori = $kategori->kategori;

        $digiflazz = new DigiflazzController;
        $this->allProduks = $digiflazz->daftarHarga($this->kategori);

        // ambil brand yang duplicate atau ambil nama brand saja
        foreach ($this->allProduks as $key) {
            $this->brands[] = $key->brand;
        }
        $this->brands = array_unique($this->brands);

        // isi brandSelect dengan array pertama
        $this->brandSelect = array_values($this->brands)[0];

        $this->produkBrands = array_filter($this->allProduks, fn ($item) =>
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
    }

    public function hydrateFoo($brand)
    {
        $this->brandSelect = $brand;
    }
}
