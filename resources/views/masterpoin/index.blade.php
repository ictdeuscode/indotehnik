@extends('layouts.dashboard')

@section('title')
    Master Poin
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('masterpoin') }}
@endsection

@section('content')
    <div class="container-fluid">
        <br>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <form class="form-inline">
                            <button type="submit" class="btn btn-primary mb-2">Export Data</button>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <form class="form-inline">
                            <form action="">
                                <div class="input-group mb-2">
                                    <input type="date" value="" name="startDateInput" class="form-control">
                                    <input type="date" value="" name="endDateInput" class="form-control">
                                    <div class="input-group-append">
                                        <button id="filterBtn" class="btn btn-primary">Filter Tanggal</button>
                                    </div>
                                </div>
                            </form> 
                        </form>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control mb-2" style="width: 100%" id="" placeholder="Search">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @include('masterpoin.listmasterpoin')
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
