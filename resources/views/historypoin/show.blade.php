@extends('layouts.dashboard')
@section('title')
    Detail Poin Karyawan
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('detail_historypoin_title', $laporanpoinkaryawan) }}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Progress
                </div>
                <div class="card-body">
                <table id="datatable" class="row-border hover table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Nama Customer</th>
                            <th>Nama Barang</th>
                            <th>Tanggal Masuk</th>
                            <th>Tanggal Keluar</th>
                            <th>Nama Operator</th>
                            <th>Nama Mesin</th>
                            <th>Keterangan Proses</th>
                            <th>Poin Didapat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($progress as $index => $p)
                            <tr>
                                <td>{{ $p->preorder->nomor }}</td>
                                <td>{{ $p->preorder->customer }}</td>
                                <td>{{ $p->preorder->nama_barang }}</td>
                                <td>{{ $p->tanggal }}</td>
                                <td>{{ empty($p->tanggal_keluar) ? '-' : $p->tanggal_keluar }}</td>
                                <td>{{ $p->operator->nama }}</td>
                                <td>{{ $p->mesin->nama }}</td>
                                <td>{{ $p->keterangan_proses }}</td>
                                <td>{{ $p->poin_didapat }}</td>
                                <td>
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#modalTambah_{{ $index }}">
                                        <i class="fas fa-plus"></i>
                                    </button>

                                    <div class="modal fade" id="modalTambah_{{ $index }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Poin</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('editpoin') }}" class="needs-validation" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id_operator" value="{{$p->operator->id}}">
                                                        <input type="hidden" name="id_history_surat" value="{{$p->id}}">
                                                        <input type="hidden" name="action_type" value="TAMBAH">
                                                        <p>Masukkan nominal poin yang ingin ditambahkan </p>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="poin" >Poin</label>
                                                                    <div class="col-sm-12 p-0">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span style="background-color: #030f27"
                                                                                    class="input-group-text"><i style="color: white"
                                                                                        class="fas fa-coins"></i></span>
                                                                            </div>
                                                                            <input type="number" value="{{ old('poin') }}"
                                                                                class="form-control @error('poin') is-invalid @enderror"
                                                                                name="poin" id="poin" min="1" required />
                                                                            @error('poin')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nomor</th>
                            <th>Nama Customer</th>
                            <th>Nama Barang</th>
                            <th>Tanggal Masuk</th>
                            <th>Tanggal Keluar</th>
                            <th>Nama Operator</th>
                            <th>Nama Mesin</th>
                            <th>Keterangan Proses</th>
                            <th>Poin Didapat</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Penukaran Poin
                </div>
                <div class="card-body">
                <table id="datatable2" class="row-border hover table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>Tanggal Penukaran</th>
                            <th>Poin Ditukar</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($exchanges as $exchange)
                            <tr>
                                <td>{{ $exchange->tanggal }}</td>
                                <td>{{ $exchange->poin }}</td>
                                <td>{{ $exchange->keterangan ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css-internal')
    <style>
        .category-tumbnail {
            width: 100%;
            height: 400px;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }
    </style>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.jqueryui.min.css">
@endpush

@push('javascript-external')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.jqueryui.min.js"></script>

    <script>

    $(document).ready( function () {
        var dataTable = $('#datatable').DataTable({
            "autoWidth": false,
            "columnDefs": [
                { "width": "10%", "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8] }
            ],
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var input = $('<input type="text" placeholder="Search..."/>')
                        .appendTo($(column.footer()).empty())
                        .on('keyup change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val ? val : '', true, false).draw();
                        });
                });
            }
        });

        $('#datatable2').DataTable({
            "autoWidth": false,
            "columnDefs": [{
                    "width": "10%",
                    "targets": 0
                },{
                    "width": "45%",
                    "targets": 1
                },
                {
                    "width": "45%",
                    "targets": 2
                }
            ]
        });
    });

    </script>
@endpush
