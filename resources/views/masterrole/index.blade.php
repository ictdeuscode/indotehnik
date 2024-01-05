@extends('layouts.dashboard')

@section('title')
    Master Role
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('masterrole') }}
@endsection

@section('content')
    <div class="container-fluid">
        <br>
        <div class="card">
            <div class="card-header">
                <a href="{{ route('masterrole.create') }}">
                    <button type="button" class="btn btn-primary my-auto">
                        Tambah Data
                    </button>
                </a>

                <!-- Button trigger modal -->
                

                <!-- Modal Function -->

            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @include('masterrole.listmasterrole')
                </ul>
            </div>
        </div>
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
