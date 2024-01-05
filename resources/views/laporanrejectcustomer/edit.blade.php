@extends('layouts.dashboard')

@section('title')
Edit Reject Customer
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('edit_laporanrejectcustomer', 'laporanrejectcustomer') }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('laporanrejectcustomer.update', ['laporanrejectcustomer' => $laporanrejectcustomer]) }}" method="POST">
                    <!-- title -->
                    @method('PUT')
                    @csrf
                    <fieldset>
                        <div class="form-group row inputGroupContainer">
                            <label class="col-sm-2 col-form-label font-weight-bold">Surat Order</label>
                            <div class="col-sm-10">
                                <input type="text" id="id_surat" class="form-control" name="id_surat" value="{{ $laporanrejectcustomer->preorder->nomor }}" readonly>
                                @error('id_surat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row inputGroupContainer mb-0">
                            <label class="col-sm-2 col-form-label font-weight-bold"></label>
                            <div class="col-sm-10">
                                <div class="card mb-3" id="card-surat-order">
                                    <div class="card-body">
                                        <p style="font-weight: bold;">Nama Customer : <span id="nama-customer">{{ $laporanrejectcustomer->preorder->customer }}</span></p>
                                        <p style="font-weight: bold; margin-bottom: 0;">Nama Barang : <span id="nama-barang">{{ $laporanrejectcustomer->preorder->nama_barang }}</span> </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row inputGroupContainer">
                            <label class="col-sm-2 col-form-label font-weight-bold">Keterangan Reject</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="keterangan_reject" name="keterangan_reject" required>{{ $laporanrejectcustomer->keterangan_reject }}</textarea>
                                @error('keterangan_reject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                    <div class="float-right">
                        <a class="btn btn-warning px-4" href="{{ route('laporanrejectcustomer.index') }}">Back</a>
                        <button type="submit" class="btn btn-primary px-4">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection