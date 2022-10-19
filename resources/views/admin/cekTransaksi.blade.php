@extends('layouts.main')
@section('konten')

    @guest
        <form action="/cekTransaksi" method="POST">
            @csrf
            <h6 class="label-control">* Masukkan no referensi pesanan untuk melihat salah satu transaksi</h6>
            <h6 class="label-control">* Masukkan email untuk melihat daftar transaksi yang pernah
                dilakukan</h6>
            <div class="input-group">
                <input type="text" name="ref_email" class="form-control" placeholder="email / no referensi" required
                    autocomplete="off">
                <button type="submit" class="btn btn-primary" required>Cek</button>
            </div>
        </form>
    @endguest
    @isset($data)
        <table class="table table-striped table-fluid mt-5">
            <tr>
                <th>Tanggal</th>
                <th>Email</th>
                <th>Game</th>
                <th>Reference</th>
                <th>Merchant ref</th>
                <th>Pembayaran</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
            @foreach ($data as $v)
                <tr>
                    <td>{{ $v->created_at }}</td>
                    <td><?= $v['email'] ?></td>
                    <td>{{ $v->game->judul_game }}</td>
                    <td><a href="https://tripay.co.id/checkout/{{ $v->reference }}" target="blank">{{ $v->reference }}</a></td>
                    <td>{{ $v->merchant_ref }}</td>
                    <td>{{ $v->channel }}</td>
                    <td>{{ number_format($v->amount) }}</td>
                    <td class="{{ $v->status == 'PAID' ? 'text-primary' : 'text-danger' }}">{{ $v->status }}</td>
                </tr>
            @endforeach
        </table>
    @endisset
@endsection
