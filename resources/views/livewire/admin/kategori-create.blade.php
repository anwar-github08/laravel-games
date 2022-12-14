<div>
    <div class="card">
        <div class="card-header">Kategori Baru</div>
        <div class="card-body">
            <form wire:submit.prevent="storeKategori">
                <select wire:model='kategori' wire:change='change' class="form-control">
                    <option value="null">-- Pilih --</option>
                    @foreach ($notYet as $ny)
                        <option value="{{ $ny }}">{{ $ny }}</option>
                    @endforeach
                </select>
                @if ($formUpload)
                    <label for="" class="mb-2 mt-3">Image</label>
                    <input type="file" wire:model='kategori_img'
                        class="mb-2 @error('kategori_img') is-invalid @enderror">
                    @error('kategori_img')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <button class="btn btn-primary mt-3">Tambahkan</button>
                @endif
            </form>
        </div>
    </div>

    <div wire:loading>
        <img src="/img/loading/loading.png">
    </div>
</div>
