@extends('layouts.dashboard')

@section('title')
    Laporan Poin Karyawan
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('historypoin') }}
@endsection

@section('content')
    <div class="container-fluid">
        <br>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-7">
                        <form action="{{ route('exporthistorypoin') }}" method="POST">
                            @csrf
                            <input type="hidden" value="<?php echo $tanggal; ?>" name="startDateInput"
                                        class="form-control">
                            <input type="hidden" value="<?php echo $tanggal2; ?>" name="endDateInput"
                                class="form-control">
                                <input class="form-control w-100" type="hidden" name="nama_operator_filter" value="{{ $namaOperatorFilter }}" placeholder="Search...">
                            <button type="submit" class="btn btn-primary mb-2">
                                Export Data
                            </button>
                        </form>
                    </div>
                    <div class="col-md-5">
                        <div class="form-inline">
                            <form action="<?php echo url('dashboard/laporanpoinkaryawan'); ?>">
                                <div class="input-group mb-2">
                                    <input type="date" value="<?php echo $tanggal; ?>" name="startDateInput"
                                        class="form-control">
                                    <input type="date" value="<?php echo $tanggal2; ?>" name="endDateInput"
                                        class="form-control">
                                    <input class="form-control w-100" type="hidden" name="nama_operator_filter" value="{{ $namaOperatorFilter }}" placeholder="Search...">
                                    <div class="input-group-append">
                                        <button id="filterBtn" class="btn btn-primary">Filter Tanggal</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @include('historypoin.listhistorypoin')
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

        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
@endpush
