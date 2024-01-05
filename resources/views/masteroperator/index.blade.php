@extends('layouts.dashboard')

@section('title')
    Master Operator
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('masteroperator') }}
@endsection

@section('content')
    <div class="container-fluid">
        <br>
        <div class="card">
            <div class="card-header">
                <a href="{{ route('masteroperator.create') }}">
                    <button type="button" class="btn btn-primary my-auto">
                        Tambah Data
                    </button>
                </a>

                {{-- <a href="{{ route('masteroperator.qr-code') }}">
                    <button type="button" class="btn btn-success">
                        Print QR
                    </button>
                </a> --}}

            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @include('masteroperator.listmasteroperator')
                </ul>
            </div>
        </div>
    </div>
@endsection

@push('javascript-internal')
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
                    confirmButtonText:$(this).attr('alert-btn-yes'),
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
