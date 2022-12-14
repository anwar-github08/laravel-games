<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Kategori;
use App\Http\Controllers\DigiflazzController;
use Livewire\WithFileUploads;

class KategoriCreate extends Component
{
    use WithFileUploads;


    public $notYet;

    public $kategori;
    public $kategori_img;

    public $formUpload = false;

    public function mount()
    {
        $digiflazz = new DigiflazzController;

        // kategori dari tabel
        $kategoris = Kategori::all();

        foreach ($kategoris as $key) {
            $tb_kategori[] = $key->kategori;
        }

        // kategori dari digiflazz
        $kategoris = $digiflazz->allProduk();
        foreach ($kategoris as $key) {
            $kategori[] = $key->category;
        }
        $digiKategoris = array_unique($kategori);


        if (empty($tb_kategori)) {
            $this->notYet = $digiKategoris;
        } else {
            $this->notYet = array_diff($digiKategoris, $tb_kategori);
        }
    }

    public function render()
    {
        return view('livewire.admin.kategori-create');
    }

    // ================================================== emit =================================================

    // ================================================== end emit =================================================

    public function storeKategori()
    {
        $validated = $this->validate([
            'kategori' => 'required',
            'kategori_img' => 'image|max:1024'
        ]);

        $imgName = $this->kategori . '.' . $this->kategori_img->extension();

        $this->kategori_img->storeAs('kategori', $imgName, 'public');

        $validated['kategori_img'] = $imgName;

        Kategori::create($validated);

        $this->emit('eStoreKategori');
    }

    public function change()
    {
        if ($this->kategori !== 'null') {
            $this->formUpload = true;
        } else {
            $this->formUpload = false;
        }
    }
}
