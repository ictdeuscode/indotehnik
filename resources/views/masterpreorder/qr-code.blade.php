{{-- 
@foreach ($qr_codes as $qr_code)
    <div class="qr-code-container">
        <div class="qr-code"><img src="{{ $qr_code['qr_code'] }}" alt="{{ $qr_code['code'] }}"></div>
        <div class="nomor">{{ $qr_code['code'] }}</div>
    </div>
@endforeach
 --}}

<!-- resources/views/masterpreorder/qr-code.blade.php -->

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>QR Codes</title>
    <style>
        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        .col-md-4 {
            float: left;
            width: 33.33%;
            padding: 0 15px;
            margin-bottom: 30px;
        }

        .card {
            border: none;
            border-radius: 0;
            box-shadow: none;
            margin-bottom: 30px;
            text-align: center;
        }

        .card img {
            max-width: 100%;
            height: auto;
        }

        .card-title {
            font-size: 1.5rem;
            margin-top: 0px;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            .container,
            .container * {
                visibility: visible;
            }

            .container {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>QR Codes</h1>
        <a href="{{ url('/download-pdf') }}">Download PDF</a>
        <div class="row">
            @foreach ($qr_codes as $qr_code)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ $qr_code['qr_code'] }}" alt="{{ $qr_code['code'] }}"
                                class="img-fluid mx-auto d-block mb-3">
                            <h4 class="card-title text-center">{{ $qr_code['code'] }}</h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
