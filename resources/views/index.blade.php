@extends('layouts.main')

@section('konten')
    <div id="carouselExampleDark" class="carousel slide mt-5" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="5000">
                <img src="/img/carousel/ml.jpg" class="d-block w-100" alt="...">
                {{-- <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div> --}}
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <img src="/img/carousel/ff.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="4000">
                <img src="/img/carousel/valorant.png" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="d-flex justify-content-evenly mt-5">
        @foreach ($kategoris as $kategori)
            <form action="/produk" method="POST">
                @csrf
                <div class="card-item">
                    <input type="hidden" name="kategori" value="{{ $kategori->kategori }}">
                    <button class="bg-transparent text-center border-0">
                        <div class="img-item">
                            <img src="/storage/kategori/{{ $kategori->kategori_img }}">
                        </div>
                        <div class="desc-item">
                            {{ $kategori->kategori }}
                        </div>
                    </button>
                </div>
            </form>
        @endforeach
    </div>
@endsection
