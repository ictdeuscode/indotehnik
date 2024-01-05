@extends('layouts.dashboard')

@section('title')
    QR Pegawai
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('QR_masterpegawai', $masterPegawaiQR) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <img src="data:image/png;base64, {!! base64_encode($masterPegawaiQR) !!}">
                    <p>{{$data->nama}}</p>
                    <br>
                    <a class="btn btn-warning px-4" href="{{ route('masterpegawai.index') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css-internal')
    <style>
        .category-tumbnail {
            width: 100%;
            height: 400px;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }
    </style>
@endpush
