<div>
    <form action="/produk" method="POST" class="mb-4">
        @csrf
        <input type="hidden" name="kategori" value="{{ $kategori }}">
        <button onclick="return confirm('Batal..?')" class="text-me border-0 bg-transparent">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-left" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <polyline points="11 7 6 12 11 17"></polyline>
                <polyline points="17 7 12 12 17 17"></polyline>
            </svg> Back
        </button>
    </form>

    <form wire:submit.prevent='storeTransaksi'>
        <div class="row">
            <div class="col-md-6">

                <div class="card-topup mb-4">
                    <label for="" class="label-control mt-3">Produk</label>
                    <input type="text" wire:model='nama_produk' class="form-control mt-2" readonly>

                    <label for="" class="label-control mt-3">Kode Produk</label>
                    <input type="text" wire:model='kode_produk' class="form-control mt-2" readonly>

                    <label for="" class="label-control mt-3">Harga Produk</label>
                    <input type="text" wire:model='harga' class="form-control mt-2" readonly>

                    <label for="" class="label-control mt-3">No Telp</label>
                    <input type="text" wire:model='no_telf'
                        class="form-control mt-2 @error('no_telf') is-invalid @enderror" required>
                    @error('no_telf')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            {{-- tripay channels --}}
            <div class="col-md-6">

                {{-- <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button white bg-me" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseOne">
                                <div class="petunjuk">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bike"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="5" cy="18" r="3"></circle>
                                        <circle cx="19" cy="18" r="3"></circle>
                                        <polyline points="12 19 12 15 9 12 14 8 16 11 19 11"></polyline>
                                        <circle cx="17" cy="5" r="1"></circle>
                                    </svg>
                                </div> &nbsp;
                                PETUNJUK
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                            aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body white bg-me">
                                <strong>Ketika Anda Tidak Login.</strong>
                                <hr>
                                Anda bisa melihat Riwayat Transaksi dengan email yang pernah anda gunakan untuk
                                transaksi.
                                <br>
                                - Klik icon menu ( <svg data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                    aria-controls="offcanvasRight" xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-menu-2" width="20" height="20"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="4" y1="6" x2="20" y2="6"></line>
                                    <line x1="4" y1="12" x2="20" y2="12"></line>
                                    <line x1="4" y1="18" x2="20" y2="18"></line>
                                </svg> ) , pilih Riwayat Transaksi, dan masukkan email anda.
                                <br><br>
                                <strong>Ketika Anda Login.</strong>
                                <hr>
                                Anda langsung bisa melihat Riwayat Transaksi.
                                <br>
                                - Klik icon menu ( <svg data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                    aria-controls="offcanvasRight" xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-menu-2" width="20" height="20"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="4" y1="6" x2="20" y2="6"></line>
                                    <line x1="4" y1="12" x2="20" y2="12"></line>
                                    <line x1="4" y1="18" x2="20" y2="18"></line>
                                </svg> ) , pilih Riwayat Transaksi.
                            </div>
                        </div>
                    </div>
                </div> --}}

                @if ($error_transaksi)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Message..!!</strong> {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row row-cols-1 row-cols-4 row-cols-lg-6 g-2 mb-5">
                    @csrf
                    @foreach ($channels as $channel)
                        <div class="col">
                            <input type="radio"
                                wire:click="storeBiaya('{{ $channel->total_fee->flat }}','{{ $channel->total_fee->percent }}','{{ $channel->group }}','{{ $channel->code }}')"
                                wire:model='method' value="{{ $channel->code }}" id="{{ $channel->code }}" required>

                            <label for="{{ $channel->code }}" class="d-inline">
                                <div class="card h-100">
                                    <img src="{{ $channel->icon_url }}" class="card-img-top">
                                    <p class="biaya">Rp. {{ $channel->total_fee->flat }} +
                                        {{ $channel->total_fee->percent }}%</p>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('method')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <div wire:loading>
                    <img src="/img/loading/loading.png">
                </div>
                <div wire:loading.remove>
                    <h6 class="text-white">{{ $biaya }}</h6>
                </div>

                @if ($ewallet)
                    <div class="input-ewallet mb-3">
                        <input type="text" wire:model='nomor_ewallet'
                            class="form-control @error('nomor_ewallet') is-invalid @enderror"
                            placeholder="{{ $placeholder_ewallet }}">
                    </div>
                    @error('nomor_ewallet')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                @endif


                <div class="input-group">
                    @auth
                        <input type="text" wire:model="email" class="form-control" value="{{ auth()->user()->email }}"
                            readonly>
                    @else
                        <input type="text" wire:model="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Email" required autocomplete="off">
                    @endauth
                    <button type="submit" class="btn btn-primary">Lanjutkan</button>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
    </form>

</div>
