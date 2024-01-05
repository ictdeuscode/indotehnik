<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR Scan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>

<body>

    <div class="container col-lg-4 py-5">

        <div class="card bg-white shadow rounded-3 p-3 border-0">

            @if (session()->has('gagal'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('gagal') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="wrapper">
                <div class="scanner"></div>

                <video id="preview"></video>

            </div>
        </div>

        {{-- //menyimpan hasil scan --}}

        <form action="{{ route('storemesin') }}" method="POST" id="form">
            @csrf
            <input type="hidden" name="kode" id="kode">
        </form>


        <div class="table-responsive mt-5">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Nama</th>
                    <th>Tanggal</th>



                </tr>
                @foreach ($kode as $item)
                    <tr>

                        @if (empty($item->mastermesin) || empty($item->mastermesin->nama))
                            <td colspan="2">
                                @php
                                    $dataNotEmpty = 0;
                                @endphp
                            </td>
                        @else
                            <td>{{ $item->mastermesin->nama }}</td>



                            <td>{{ $item->tanggal }}</td>
                        @endif

                    </tr>
                    @php
                        session()->put('ambil_nama_mesin', $item->mastermesin->nama);
                        session()->save();
                    @endphp
                @endforeach

            </table>
        </div>
    </div>

    <script type='text/javascript' src='https://rawgit.com/schmich/instascan-builds/master/instascan.min.js'></script>
    <script type="text/javascript">
        var scanner = new Instascan.Scanner({ 
           video: document.getElementById('preview'), 
           mirror: false 
        });
        scanner.addListener('scan', function(content) {
            console.log(content);
        });
        Instascan.Camera.getCameras().then(function(cameras) {
            console.log(cameras);
            if (cameras.length > 0) {
                scanner.start(cameras[1]);
            } else
            {
                console.error('No cameras found.');
            }
        }).catch(function(e) {
            console.error(e);
        });

        scanner.addListener('scan', function(c) {
            console.log("scan " + c);
            document.getElementById('kode').value = c;
            document.getElementById('form').submit();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>


</html>
