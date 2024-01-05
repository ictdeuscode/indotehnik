@extends('layouts.dashboard')
@section('title')
    Detail Mesin
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('detail_mastermesin_title', $mastermesin) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <h2 class="my-1">
                        {{ $mastermesin->nama }}
                    </h2>
                    <br>
                    <!-- description -->
                    <div class="form-group row inputGroupContainer">
                        <label class="col-md-2 col-form-label font-weight-bold">Kode</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    {{-- <span class="input-group-text">$</span> --}}
                                    <span style="background-color: #030f27" class="input-group-text"><i style="color: white"
                                            class="fa fa-code fa-xs"></i></span>
                                </div>
                                <input type="text" value="{{ $mastermesin->kode }}" class="form-control  name="kode"
                                    id="kode" readonly />
                            </div>
                        </div>
                    </div>

                    <div class="form-group row inputGroupContainer">
                        <label class="col-md-2 col-form-label font-weight-bold">Nama</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    {{-- <span class="input-group-text">$</span> --}}
                                    <span style="background-color: #030f27" class="input-group-text"><i style="color: white"
                                            class="fa fa-id-card fa-xs"></i></span>
                                </div>
                                <input type="text" value="{{ $mastermesin->nama }}" class="form-control  name="kode"
                                    id="kode" readonly />
                            </div>
                        </div>
                    </div>

                    <div class="form-group row inputGroupContainer">
                        <label class="col-md-2 col-form-label font-weight-bold">Kapasitas</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    {{-- <span class="input-group-text">$</span> --}}
                                    <span style="background-color: #030f27" class="input-group-text"><i style="color: white"
                                            class="fa fa-road fa-xs"></i></span>
                                </div>
                                <input type="text" value="{{ $mastermesin->kapasitas }}" class="form-control  name="kode"
                                    id="kode" readonly />
                            </div>
                        </div>
                    </div>

                    <div class="form-group row inputGroupContainer">
                        <label class="col-md-2 col-form-label font-weight-bold">Keterangan</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    {{-- <span class="input-group-text">$</span> --}}
                                    <span style="background-color: #030f27" class="input-group-text"><i style="color: white"
                                            class="fa fa-map-signs fa-sm"></i></span>
                                </div>
                                <input type="text" value="{{ $mastermesin->keterangan }}"
                                    class="form-control  name="kode" id="kode" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('mastermesin.index') }}" class="btn btn-warning px-4" role="button">
                            Back
                        </a>
                    </div>
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
