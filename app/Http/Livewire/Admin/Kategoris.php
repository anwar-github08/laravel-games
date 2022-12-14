<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Kategori;

class Kategoris extends Component
{

    public function render()
    {
        return view('livewire.admin.kategoris', [

            'kategoris' => Kategori::all()

        ]);
    }

    public function hapusKategori($id, $img)
    {
        Kategori::destroy($id);
        unlink(public_path('storage/kategori/' . $img));
    }

    // ================================================== emit =================================================

    public function getListeners()
    {
        return [

            'eStoreKategori', // event dari kategori-create ketika data ditambahkan

        ];
    }

    public function eStoreKategori()
    {

        session()->flash('sukses', 'berhasil ditambahkan');
    }

    // ================================================== end emit =================================================
}
