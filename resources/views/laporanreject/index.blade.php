@extends('layouts.dashboard')

@section('title')
    Laporan Reject
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('laporanreject') }}
@endsection

@section('content')
    <div class="container-fluid">
        <br>
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <div class="col-md-7">
                        <form action="{{ route('exportlaporanreject') }}" method="POST">
                            @csrf
                            <input class="form-control w-100" type="hidden" value="{{ $nomorOrderFilter }}" name="nomor_order_filter" placeholder="Search...">
                            <input class="form-control w-100" type="hidden" value="{{ $namaCustomerFilter }}" name="nama_customer_filter" placeholder="Search...">
                            <input class="form-control w-100" type="hidden" value="{{ $namaBarangFilter }}" name="nama_barang_filter" placeholder="Search...">
                            <input type="hidden" name="tanggal_start_filter" value="{{ $tanggalStartFilter }}"
                                class="form-control">
                            <input type="hidden" name="tanggal_end_filter" value="{{ $tanggalEndFilter }}"
                                class="form-control">
                            <input class="form-control w-100" type="hidden" value="{{ $tipeRejectFilter }}" name="tipe_reject_filter" placeholder="Search...">
                            <input class="form-control w-100" type="hidden" value="{{ $namaOperatorFilter }}" name="nama_operator_filter" placeholder="Search...">
                            <input class="form-control w-100" type="hidden" value="{{ $keteranganRejectFilter }}" name="keterangan_reject_filter" placeholder="Search...">
                            <button type="submit" class="btn btn-primary mb-2">
                                Export Data
                            </button>
                        </form>
                    </div>
                    <!-- <div class="col-md-5">
                        <div class="form-inline">
                            <form action="<?php //echo url('dashboard/laporanreject'); ?>">
                                <div class="input-group mb-2">
                                    <input type="date" value="<?php //echo $tanggal; ?>" name="startDateInput"
                                        class="form-control">
                                    <input type="date" value="<?php //echo $tanggal2; ?>" name="endDateInput"
                                        class="form-control">
                                    <div class="input-group-append">
                                        <button id="filterBtn" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div> -->
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @include('laporanreject.listlaporanreject')
                </ul>
            </div>
        </div>
    </div>
    <br>
@endsection

@push('javascript-internal')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $("form[role='alert']").submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: $(this).attr('alert-title'),
                    text: $(this).attr('alert-text'),
                    icon: 'warning',
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: $(this).attr('alert-btn-cancel'),
                    reverseButtons: true,
                    confirmButtonText: $(this).attr('alert-btn-yes'),
                }).then((result) => {
                    if (result.isConfirmed) {
                        alert("Proses Menghapus Data dari Kategori");
                        event.target.submit();
                    }
                });
            });
        });
    </script>
@endpush