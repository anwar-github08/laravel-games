<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class DigiflazzController extends Controller
{
    //

    public $username = 'cugebegKpXwo';
    public $dev_key = 'dev-855f40a0-4866-11ed-93fb-e3e725fc64b5';

    public function getKategori()
    {
        return view('index', [
            'title' => 'TOPUPAJASHOP',
            'kategoris' => Kategori::all()
        ]);
    }

    public function getProduk(Request $kategori)
    {
        $produks = $this->daftarHarga($kategori->kategori);

        // ambil brand yang duplicate atau ambil nama brand saja
        $brands = [];
        foreach ($produks as $key) {
            $brands[] = $key->brand;
        }
        $brands = array_unique($brands);


        // ambil produk berdasar brand
        $produkBrands = array_filter($produks, fn ($item) =>
        $item->brand == "INDOSAT");

        return view('produk', [
            'title' => $kategori->kategori,
            'kategori' => $kategori,
            'brands' => $brands,
            'produks' => $produks
        ]);
    }


    public function daftarHarga($kategori)
    {

        $sign = md5($this->username . $this->dev_key . 'pricelist');
        $data = [

            'cmd' => 'prepaid',
            'username' => $this->username,
            'sign' => $sign
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://api.digiflazz.com/v1/price-list',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => array('Accept: application/json', 'Content-Type: application/json'),
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        // semua data daftar produk
        $response = json_decode($response)->data;


        // filter array berdasarkan kategori yang diinginkan
        $filter = array_filter(
            $response,
            fn ($item) =>
            $item->category == $kategori
        );

        return $filter ?: $error;
    }




    public function cekSaldo()
    {

        $sign = md5($this->username . $this->dev_key . 'depo');
        $data = [

            'cmd' => 'deposit',
            'username' => $this->username,
            'sign' => $sign
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://api.digiflazz.com/v1/cek-saldo',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => array('Accept: application/json', 'Content-Type: application/json'),
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response)->data;
        dd($response);
        return $response ?: $error;
    }
}
