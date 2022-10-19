<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    <h1 class="text-white mb-3">{{ $kategori }}</h1>

    <ul class="nav nav-tabs mb-3">
        @foreach ($brands as $brand)
            <li class="nav-item">
                <a class="nav-link" wire:click="changeBrand('{{ $brand }}')">{{ $brand }}</a>
            </li>
        @endforeach
    </ul>

    <div wire:loading class="text-white text-center">
        ....
    </div>
    <div wire:loading.remove>
        <h1>{{ $brandSelect }}</h1>
    </div>
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
            @foreach ($produkBrands as $produk)
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
