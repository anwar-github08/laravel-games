<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Transaksi;
use App\Http\Controllers\TripayController;
use Illuminate\Support\Facades\Redirect;

class Pulsa extends Component
{
    public $kategori;
    public $kode_produk;
    public $nama_produk;
    public $harga;
    public $no_telf;

    public $method;
    public $email;

    public $channels;
    public $biaya;

    public $harga_fix;

    public $ewallet = false;
    public $placeholder_ewallet;
    public $nomor_ewallet;

    public $error_transaksi = false;
    public $message;

    public function render()
    {
        $tripay = new TripayController;
        $this->channels = $tripay->getPaymentChannels();

        return view('livewire.pulsa');
    }

    // validation form pulsa
    protected $rules = [
        'no_telf' => 'required|numeric|min_digits:10',
        'nomor_ewallet' => 'nullable|numeric',
        'email' => 'required|email:dns',
        'method' => 'required'
    ];

    protected $messages = [
        'no_telf.required' => 'Wajib diisi',
        'no_telf.numeric' => 'No telf harus angka',
        'nomor_ewallet.numeric' => 'No telf harus angka',
        'no_telf.min_digits' => 'No telf minimal 10',
        'email.email' => 'Format harus email',
        'method.required' => 'Wajib memilih metode pembayaran..!!'
    ];

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName, [

    //         'no_telf' => 'numeric|min_digits:10',
    //         'email' => 'email:dns'
    //     ]);
    // }

    public function storeTransaksi()
    {
        $validated = $this->validate();

        // request transaksi ke tripay
        $tripay = new TripayController;
        $transaksi = $tripay->requestTransaksi($this->nama_produk, $this->harga_fix, $this->method, $this->email, $this->nomor_ewallet);

        // jika sukses membuat transaksi, simpan data ke db Transaksis
        if ($transaksi->success == 'true') {

            Transaksi::create([
                'reference' => $transaksi->data->reference,
                'merchant_ref' => $transaksi->data->merchant_ref,
                'payment_name' => $transaksi->data->payment_name,
                'customer_name' => $transaksi->data->customer_name,
                'customer_email' => $transaksi->data->customer_email,
                'amount' => $transaksi->data->amount,
                'checkout_url' => $transaksi->data->checkout_url,
                'status' => $transaksi->data->status,
            ]);

            return Redirect::away($transaksi->data->checkout_url);
        } else {
            $this->error_transaksi = true;
            $this->message = $transaksi->message;
        }

        // jika status success = true
        // simpan data Transaksi dan redirect ke checkout_url

        // jika status success = false
        // tampilkan message
    }


    // listeners untuk menangkap emit
    protected $listeners = ['eBeliPulsa'];

    //   menjalankan emit
    public function eBeliPulsa($kategori, $kode_produk, $nama_produk, $harga)
    {
        $this->kategori = $kategori;
        $this->kode_produk = $kode_produk;
        $this->nama_produk = $nama_produk;
        $this->harga = $harga;
    }



    public function storeBiaya($flat, $persen, $group, $code)
    {
        $tripay = new TripayController;
        $this->channels = $tripay->getPaymentChannels();

        if ($group == 'E-Wallet' and $code !== 'QRIS') {
            $this->ewallet = true;
            $this->placeholder_ewallet = 'Nomor ' . $this->method;
        } else {
            $this->ewallet = false;
        }

        $persen_harga = $persen / 100 * $this->harga;
        $this->harga_fix = $this->harga + $persen_harga + $flat;

        $this->biaya = 'Total : ' . number_format($this->harga_fix);
        $this->error_transaksi = false;
    }
}


    // aksi = /requestPembayaran method=post
    // butuh:
    // 1. produk
    // 2. harga / amount
    // 3. method / code merchant
    // 4. email