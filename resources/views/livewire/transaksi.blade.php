<div class="komponen-transaksi">
    {{-- The best athlete wants his opponent at his best. --}}

    <div class="d-flex justify-content-center">
        <div wire:loading>
            <img src="/img/loading/loading.png">
        </div>
    </div>

    <div wire:loading.remove>


        @if ($pulsa)
            <livewire:pulsa>
            @elseif($pln)
                <div class="back mb-3">
                    <form action="/produk" method="POST">
                        @csrf
                        <input type="hidden" name="kategori" value="{{ $kategori }}">
                        <button class="text-me border-0 bg-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-left"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <polyline points="11 7 6 12 11 17"></polyline>
                                <polyline points="17 7 12 12 17 17"></polyline>
                            </svg> Back
                        </button>
                    </form>
                </div>
                <livewire:pln>
                @else
                    <div class="back mb-3">
                        <a href="/" class="text-me text-decoration-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-left"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <polyline points="11 7 6 12 11 17"></polyline>
                                <polyline points="17 7 12 12 17 17"></polyline>
                            </svg> Back
                        </a>
                    </div>
                    <livewire:show-produk>
        @endif


    </div>

</div>
