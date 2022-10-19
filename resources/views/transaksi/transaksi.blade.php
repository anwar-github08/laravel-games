<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <title>Detail Transaksi</title>
</head>

<body>

    <div class="container mt-5">
        <h5>Detail Transaksi</h5>
        <hr>
        <a href="/">Kembali</a>
        <div class="row g-3">
            <div class="col-lg-6 col-sm-12">
                <div class="card border-secondary mb-3">
                    <div class="card-header">
                        <h5>#{{ $data->reference }}</h5>
                        <h6>Total : {{ number_format($data->amount) }}</h6>
                        <h6>Metode pembayaran : {{ $data->payment_name }}</h6>
                        <hr>
                        <h3 class="text-danger">{{ $data->status }}</h3>
                    </div>
                </div>
                <a href="{{ $data->checkout_url }}" target="blank" class="btn btn-info btn-sm">Cek Detail Pembayaran</a>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="card border-secondary mb-3">
                    <div class="card-header">Petunjuk</div>
                    <div class="card-body">

                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            @foreach ($data->instructions as $intruction)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseOne{{ $loop->iteration }}"
                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                            {{ $intruction->title }}
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne{{ $loop->iteration }}"
                                        class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                                        data-bs-parent="#accordionFlushExample">
                                        @foreach ($intruction->steps as $step)
                                            <div class="accordion-body">{{ $loop->iteration }}. {!! $step !!}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>
