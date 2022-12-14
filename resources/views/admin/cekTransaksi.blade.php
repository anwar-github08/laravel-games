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
                    autocomplete="off" value="{{ old('ref_email') }}">
                <button type="submit" class="btn btn-primary" required>Cek</button>
            </div>
        </form>
    @endguest
    @isset($data)
        <div class="mt-5 text-center text-white">
            @if ($data->isEmpty())
                <h6><i>Data Not Found</i></h6>
            @else
                <table class="table table-striped table-fluid table-dark">
                    <tr>
                        <th>Tanggal</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Reference</th>
                        <th>Merchant Ref</th>
                        <th>Payment Name</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                    @foreach ($data as $v)
                        <tr>
                            <td>{{ $v->created_at }}</td>
                            <td>{{ $v->customer_name }}</td>
                            <td>{{ $v->customer_email }}</td>
                            <td><a href="https://tripay.co.id/checkout/{{ $v->reference }}"
                                    target="blank">{{ $v->reference }}</a>
                            </td>
                            <td>{{ $v->merchant_ref }}</td>
                            <td>{{ $v->payment_name }}</td>
                            <td>{{ number_format($v->amount) }}</td>
                            <td class="{{ $v->status == 'PAID' ? 'text-primary' : 'text-danger' }}">{{ $v->status }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    @endisset
@endsection
