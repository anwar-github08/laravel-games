@extends('layouts.main')
@section('konten')
    <div class="row">
        <div class="col-md-6 mt-2">

            <div class="card mb-3 bg-light border-dark">
                <div class="row g-2">
                    <div class="col-md-6">
                        <img src="{{ $game->gambar }}" class="img-fluid">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title">{{ $game->judul_game }}</h5>
                            <p class="card-text">{{ number_format($game->harga) }}</p>
                            <p class="card-text"><small class="text-muted">Last update
                                    {{ $game->created_at->diffForHumans() }}</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <form action="/transaksi" method="POST" class="d-inline">
                <div class="row row-cols-1 row-cols-4 g-2">
                    @csrf
                    @foreach ($channels as $channel)
                        <input type="hidden" name="game_id" value="{{ $game->id }}">
                        <div class="col">
                            <input type="radio" name="method" value="{{ $channel->code }}" id="{{ $channel->code }}"
                                required>
                            <label for="{{ $channel->code }}" class="d-inline">
                                <div class="card h-100">
                                    <img src="{{ $channel->icon_url }}" class="card-img-top">
                                </div>
                            </label>
                        </div>
                    @endforeach
                    <div class="input-group mt-5">
                        @auth
                            <input type="text" name="email" class="form-control" value="{{ auth()->user()->email }}"
                                readonly>
                        @else
                            <input type="text" name="email" class="form-control" placeholder="email" required
                                autocomplete="off">
                        @endauth
                        <button type="submit" class="btn btn-primary" required>Lanjutkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
