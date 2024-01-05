@extends('layouts.dashboard')

@section('title')
Edit Laporan Stock
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('edit_laporanstock', 'laporanstock') }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('laporanstock.update', ['laporanstock' => $laporanstock]) }}" method="POST">
                    <!-- title -->
                    @method('PUT')
                    @csrf
                    <fieldset>
                        <div class="form-group row inputGroupContainer mb-0">
                            <label class="col-sm-2 col-form-label font-weight-bold"></label>
                            <div class="col-sm-10">
                                <div class="card mb-3" id="card-surat-order">
                                    <div class="card-body">
                                        <p style="font-weight: bold; margin-bottom: 0;">Nama Barang : <span id="nama-barang">{{ $laporanstock->preorder?->nama_barang }}</span> </p>
                                        <p style="font-weight: bold; margin-bottom: 0;">Sisa Qty : <span id="nama-barang">{{ $laporanstock->preorder?->quantity }}</span> </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row inputGroupContainer">
                            <label class="col-sm-2 col-form-label font-weight-bold">Qty</label>
                            <div class="col-sm-10">
                                <input type="number" min="1" max="{{ $laporanstock->preorder?->quantity + $laporanstock->qty ?? 0 }}" class="form-control" id="qty" name="qty" value="{{ $laporanstock->qty }}">
                                @error('qty')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row inputGroupContainer">
                            <label class="col-sm-2 col-form-label font-weight-bold">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="keterangan" name="keterangan" required>{{ $laporanstock->keterangan }}</textarea>
                                @error('keterangan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                    <div class="float-right">
                        <a class="btn btn-warning px-4" href="{{ route('laporanstock.index') }}">Back</a>
                        <button type="submit" class="btn btn-primary px-4">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection