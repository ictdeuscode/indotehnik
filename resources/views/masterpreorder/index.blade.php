@extends('layouts.dashboard')

@section('title')
Master Nomor Order
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('masterpreorder') }}
@endsection

@section('content')
<div class="container-fluid">
    <br>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <a href="{{ route('masterpreorder.create') }}">
                        <button type="button" class="btn btn-primary mb-2">
                            Tambah Data
                        </button>
                    </a>
                    <a href="{{ route('exportpreorder') }}" class="btn btn-primary mb-2">
                        Export Data
                    </a>
                    <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Import Data
                </button>
                </div>
                <div class="col-md-4">
                    <div class="form-inline">
                <form action="<?php echo url('dashboard/masterpreorder'); ?>">
                    <div class="input-group mb-2">
                        <input type="date" value="<?php echo $tanggal; ?>" name="startDateInput" class="form-control">
                        <input type="date" value="<?php echo $tanggal2; ?>" name="endDateInput" class="form-control">
                        <div class="input-group-append">
                            <button id="filterBtn" class="btn btn-primary">Filter Tanggal</button>
                        </div>
                    </div>
                </form>
            </div>
                </div>
            </div>

            
            <!-- Button trigger modal -->


            <!-- Modal Function -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload File Excel</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('importpreorder') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="file" name="file">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @include('masterpreorder.listmasterpreorder')
            </ul>
        </div>
    </div>
</div>
<br>
@endsection

@push('javascript-internal')
<script>
    $(document).ready(function () {
        $("form[role='alert']").submit(function (event) {
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
