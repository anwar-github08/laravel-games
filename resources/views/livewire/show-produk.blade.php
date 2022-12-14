<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    <ul class="nav nav-tabs mb-3">
        @foreach ($brands as $brand)
            <li class="nav-item">
                @if ($brand === $brandSelect)
                    <a href="#" wire:click="changeBrand('{{ $brand }}')"
                        class="nav-link active">{{ $brand }}</a>
                @else
                    <a href="#" wire:click="changeBrand('{{ $brand }}')"
                        class="nav-link">{{ $brand }}</a>
                @endif
            </li>
        @endforeach
    </ul>

    <div class="d-flex justify-content-center">
        <div wire:loading>
            <img src="/img/loading/loading.png">
        </div>
    </div>

    <div wire:loading.remove>
        <table class="table table-bordered table-light text-center">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Actions</th>
                </tr>
            </thead>

            {{-- jika change brand bernilai true maka produkBrands formatnya array --}}
            <tbody>
                @if ($changeBrand)
                    @foreach ($produkBrands as $produk)
                        <tr>
                            <td>{{ $produk['buyer_sku_code'] }}</td>
                            <td>{{ $produk['product_name'] }}</td>
                            <td>{{ $produk['desc'] }}</td>
                            <td>{{ number_format($produk['price']) }}</td>
                            <td>
                                <button class="btn btn-danger"
                                    wire:click="$emit('eBeli','{{ $produk['category'] }}','{{ $produk['buyer_sku_code'] }}','{{ $produk['product_name'] }}','{{ $produk['price'] }}')">Beli</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    @foreach ($produkBrands as $produk)
                        <tr>
                            <td>{{ $produk->buyer_sku_code }}</td>
                            <td>{{ $produk->product_name }}</td>
                            <td>{{ $produk->desc }}</td>
                            <td>{{ number_format($produk->price) }}</td>
                            <td>
                                <button class="btn btn-danger"
                                    wire:click="$emit('eBeli','{{ $produk->category }}','{{ $produk->buyer_sku_code }}','{{ $produk->product_name }}','{{ $produk->price }}')">Beli</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>


</div>
