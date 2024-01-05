@extends('layouts.dashboard')

@section('title')
Tambah Reject Customer
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('tambah_laporanrejectcustomer') }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('laporanrejectcustomer.store') }}" method="POST">
                    <!-- title -->
                    @csrf
                    <fieldset>
                        <div class="form-group row inputGroupContainer">
                            <label class="col-sm-2 col-form-label font-weight-bold">Surat Order</label>
                            <div class="col-sm-10">
                                <select placeholder="Masukkan Surat Order" aria-label="Surat Order" aria-describedby="basic-addon2" class="custom-select form-control @error('id_surat') is-invalid @enderror js-example-basic-multiple" id="id_surat" onchange="changeSuratOrder(this)" name="id_surat" required>
                                    <option value="-">Masukkan Surat</option>
                                    @foreach($surat_orders as $surat_order)
                                    <option value="{{ $surat_order->id }}" data-customer="{{ $surat_order->customer }}" data-barang="{{ $surat_order->nama_barang }}">{{ $surat_order->nomor }}</option>
                                    @endforeach
                                </select>
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
                                <div class="card mb-3 d-none" id="card-surat-order">
                                    <div class="card-body">
                                        <p style="font-weight: bold;">Nama Customer : <span id="nama-customer"></span></p>
                                        <p style="font-weight: bold; margin-bottom: 0;">Nama Barang : <span id="nama-barang"></span> </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row inputGroupContainer">
                            <label class="col-sm-2 col-form-label font-weight-bold">Keterangan Reject</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="keterangan_reject" name="keterangan_reject" required>{{ old('keterangan_reject') }}</textarea>
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

@push('javascript-internal')
<script src="sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

    function changeSuratOrder(suratOrder) {
        $('#card-surat-order').removeClass('d-none');

        var selectedValue = $(suratOrder).val();
        var namaCustomer = "-";
        var namaBarang = "-";

        if (selectedValue != "-") {
            var selectedOption = $(suratOrder).find(':selected');

            namaCustomer = selectedOption.data("customer");
            namaBarang = selectedOption.data("barang");
        } else {
            $('#card-surat-order').addClass('d-none');
        }

        $('#nama-customer').html(namaCustomer);
        $('#nama-barang').html(namaBarang);
    }
</script>

@endpush