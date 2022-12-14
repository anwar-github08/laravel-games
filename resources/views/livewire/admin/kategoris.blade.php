<div>
    @if (session()->has('sukses'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('sukses') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div wire:loading>
        <img src="/img/loading/loading.png">
    </div>

    <table class="table table-bordered text-white text-center">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategoris as $kategori)
                <tr>
                    <td>{{ $kategori->kategori }}</td>
                    <td><img src="/storage/kategori/{{ $kategori->kategori_img }}" alt="" width="40"></td>
                    <td><a wire:click="hapusKategori({{ $kategori->id }},'{{ $kategori->kategori_img }}')"
                            class="btn btn-danger">Hapus</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @livewire('admin.kategori-create', key(time()))
</div>
