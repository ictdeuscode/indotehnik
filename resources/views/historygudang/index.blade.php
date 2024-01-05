@extends('layouts.dashboard')

@section('title')
    History Gudang
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('historygudang') }}
@endsection

@section('content')
    <div class="container-fluid">
        <br>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <a class="form-inline" href="{{ route('exporthistorygudang') }}">
                            <button type="button" class="btn btn-primary mb-2">
                                Export Data
                            </button>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <div class="form-inline">
                            <form action="<?php echo url('dashboard/historygudang'); ?>">
                                <div class="input-group mb-2">
                                    <input type="date" value="<?php echo $tanggal; ?>" name="startDateInput"
                                        class="form-control">
                                    <input type="date" value="<?php echo $tanggal2; ?>" name="endDateInput"
                                        class="form-control">
                                    <div class="input-group-append">
                                        <button id="filterBtn" class="btn btn-primary">Filter Tanggal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <form class="input-group mb-2">
                            <!-- <input class="form-control sm-2" type="search" placeholder="Cari..." aria-label="Search"> -->
                            <select value="{{ old('history_surat') }}" placeholder="Cari..." aria-label="history_surat"
                                aria-describedby="basic-addon2"
                                class="custom-select form-control @error('history_surat') is-invalid @enderror js-example-basic-multiple"
                                id="history_surat" name="history_surat" style="width: 100%; line-height:38px">
                                <option value=""> </option>
                                <?php
                                $servername = 'localhost:3306';
                                
                                if(env('DB_USED') == 'production')
                                {
                                    $username = 'u1642703_indotehnik';
                                    $password = 'indotehnik@deus.code';
                                    $dbname = 'u1642703_indotehnik';
                                }
                                else if(env('DB_USED') == 'local')
                                {
                                    $username = 'root';
                                    $password = '';
                                    $dbname = 'indotehnik';
                                }


                                
                                // Create connection
                                $conn = new mysqli($servername, $username, $password, $dbname);
                                // Check connection
                                if ($conn->connect_error) {
                                    die('Connection failed: ' . $conn->connect_error);
                                }
                                $sql = 'SELECT id FROM history_surats';
                                $result = $conn->query($sql);
                                
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['id'] . '">' . $row['id'] . ' </option>';
                                    }
                                } else {
                                    echo '0 results';
                                }
                                $conn->close();
                                
                                ?>
                            </select>

                            @error('history_surat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @include('historygudang.listhistorygudang')
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
                        alert("Proses Menghapus Data dari Kategori");
                        event.target.submit();
                    }
                });
            });
        });
    </script>
@endpush
