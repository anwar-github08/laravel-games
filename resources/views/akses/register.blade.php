@extends('layouts.main')

@section('konten')
    <div class="row justify-content-center">
        <div class="col-md-4 register text-center">

            @if (session()->has('registerSucces'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>{{ session('registerSucces') }} </strong> | <a href="/login">Klik untuk Login..!!</a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="/register" method="POST" class="mb-3">
                @csrf

                <div class="form-floating">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Nama Lengkap" required autocomplete="off" value="{{ old('name') }}">
                    <label for="">Nama Lengkap</label>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input type="text" name="email" placeholder="Email"
                        class="form-control @error('email') is-invalid @enderror" required autocomplete="off"
                        value="{{ old('email') }}">
                    <label for="">Email</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password" required autocomplete="off">
                    <label for="">Password</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-4">Register</button>
            </form>

        </div>
    </div>
@endsection
