<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TripayController extends Controller
{
    // get channels
    public function getPaymentChannels()
    {

        $apiKey = env('API_KEY');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/payment-channel',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response)->data;
        return $response ? $response : $error;
    }



    // get detail transaksi
    // API ini digunakan untuk membuat transaksi baru atau melakukan generate kode pembayaran untuk jenis Open Payment
    public function requestTransaksi($produk, $amount, $method, $email, $nomor)
    {

        // jika ada login
        if (auth()->guard()->check()) {

            $customer_name = auth()->user()->name;
            $customer_email = auth()->user()->email;
        } else {

            $customer_name = 'User';
            $customer_email = $email;
        }

        $apiKey       = env('API_KEY');
        $privateKey   = env('API_PRIVATE_KEY');
        $merchantCode = env('API_MERCHANT_CODE');
        $merchantRef  = 'MR-' . time();
        $amount       = $amount;

        $data = [
            'method'         => $method,
            'merchant_ref'   => $merchantRef,
            'amount'         => $amount,
            'customer_name'  => $customer_name,
            'customer_email' => $customer_email,
            'customer_phone' => $nomor,
            'order_items'    => [
                [
                    'name'        => $produk,
                    'price'       => $amount,
                    'quantity'    => 1,
                    'product_url' => 'https://tokokamu.com/product/nama-produk-1',
                    'image_url'   => 'https://tokokamu.com/product/nama-produk-1.jpg',
                ]
            ],
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response);
        return $response ?: $error;
    }



    // API ini digunakan untuk mengambil detail transaksi open payment yang pernah dibuat
    public function detailTransaksi($reference)
    {

        $apiKey = env('API_KEY');

        $payload = ['reference'    => $reference];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/detail?' . http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response)->data;

        return $response ?: $error;
    }
}
