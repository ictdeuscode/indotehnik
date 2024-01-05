@extends('layouts.dashboard')

@section('title')
    Master Permission Role
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('masterpermissionrole') }}
@endsection

@section('content')
    <div class="container-fluid">
        <br>
        @include('masterpermissionrole.listpermissionrole')
    </div>
    <br>
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
                    confirmButtonText: $(this).attr('alert-btn-yes'),
                }).then((result) => {
                    if (result.isConfirmed) {
                        alert("Proses Menghapus Data");
                        event.target.submit();
                    }
                });
            });
        });
    </script>
@endpush
