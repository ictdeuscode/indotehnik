@extends('layouts.dashboard')

@section('title')
    Laporan Detail Pengerjaan
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('historysurat') }}
@endsection

@section('content')
    <div class="container-fluid">
        <br>
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <div class="col-md-5">
                        <form action="{{ route('exporthistorysurat') }}" method="POST">
                            @csrf
                            <input class="form-control w-100" value="{{ $nomorOrderFilter }}" type="hidden" name="nomor_order_filter" placeholder="Search...">
                            <input class="form-control w-100" value="{{ $namaCustomerFilter }}" type="hidden" name="nama_customer_filter" placeholder="Search...">
                            <input class="form-control w-100" value="{{ $namaBarangFilter }}" type="hidden" name="nama_barang_filter" placeholder="Search...">
                            <input type="hidden" name="tanggal_masuk_start_filter"
                                class="form-control" value="{{ $tanggalMasukStartFilter }}">
                            <input type="hidden" name="tanggal_masuk_end_filter" value="{{ $tanggalMasukEndFilter }}"
                                class="form-control">
                            <input type="hidden" value="{{ $tanggalKeluarStartFilter }}" name="tanggal_keluar_start_filter"
                                class="form-control">
                            <input type="hidden" value="{{ $tanggalKeluarEndFilter }}" name="tanggal_keluar_end_filter"
                                class="form-control">
                            <input class="form-control w-100" value="{{ $namaOperatorFilter }}" type="hidden" name="nama_operator_filter" placeholder="Search...">
                            <input class="form-control w-100" value="{{ $namaMesinFilter }}" type="hidden" name="nama_mesin_filter" placeholder="Search...">
                            <input class="form-control w-100" value="{{ $keteranganFilter }}" type="hidden" name="keterangan_filter" placeholder="Search...">
                            <input class="form-control w-100" value="{{ $keteranganProsesFilter }}" type="hidden" name="keterangan_proses_filter" placeholder="Search...">
                            <button type="submit" class="btn btn-primary mb-2">
                                Export Data
                            </button>
                        </form>
                    </div>
                    <!-- <div class="col-md-7">
                        <div class="form-inline">
                            <form action="<?php //echo url('dashboard/laporandetailpengerjaan'); ?>">
                                <div class="input-group mb-2">
                                    <input type="text" value="<?php //echo $namaCustomer; ?>" name="namaCustomer" placeholder="Nama Customer / Nomor Order"
                                        class="form-control">
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
                    @include('historysurat.listhistorysurat')
                </ul>
            </div>
        </div>
    </div>
    <br>
@endsection

@push('javascript-internal')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />
                <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> -->
    <script>
        $(document).ready(function() {
            // let table = new DataTable('#tabelHistorySurat');
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
