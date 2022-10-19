@extends('layouts.main')

@section('konten')
    <div class="back mb-3">
        <a href="/" class="text-me text-decoration-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-left" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <polyline points="11 7 6 12 11 17"></polyline>
                <polyline points="17 7 12 12 17 17"></polyline>
            </svg> Back
        </a>
    </div>

    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a href="#" class="nav-link active">Test</a>
        </li>
        @foreach ($brands as $brand)
            <li class="nav-item">
                <a href="#" class="nav-link">{{ $brand }}</a>
            </li>
        @endforeach
    </ul>

    <br>
    <table class="table table-bordered table-light text-center">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Harga Awal</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produks as $produk)
                <tr>
                    <td>{{ $produk->buyer_sku_code }}</td>
                    <td>{{ $produk->brand }}</td>
                    <td>{{ number_format($produk->price) }}</td>
                    <td>{{ number_format($produk->price + 200) }}</td>
                    <td>{{ $produk->desc }}</td>
                    <td><a href="" class="btn btn-info btn-sm">Beli</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
