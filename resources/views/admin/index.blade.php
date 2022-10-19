@extends('layouts.main')
@section('konten')
    <table class="table table-striped table-bordered border-dark">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>User</th>
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
                <td>{{ $loop->iteration }}</td>
                <td>{{ $v->created_at }}</td>
                <td>{{ $v->user->name }}</td>
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
@endsection
