@extends('layouts.dashboard')
@section('title')
    Detail Pengerjaan
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('detail_historysurat_title', $laporandetailpengerjaan) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <!-- title -->
                    <h2 class="my-1">
                        {{ $laporandetailpengerjaan->no_surat }}
                    </h2>
                    <br>
                    <div class="form-group row inputGroupContainer">
                        <label class="col-md-2 col-form-label font-weight-bold">Nama Customer</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span style="background-color: #030f27" class="input-group-text"><i style="color: white"
                                            class="fa fa-id-card fa-xs"></i></span>
                                </div>
                                <input type="text" value="{{ $laporandetailpengerjaan->preorder->customer }}"
                                    class="form-control"  name="customer" id="customer" readonly />
                            </div>
                        </div>
                    </div>

                    <div class="form-group row inputGroupContainer">
                        <label class="col-md-2 col-form-label font-weight-bold">Nama Barang</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span style="background-color: #030f27" class="input-group-text"><i style="color: white"
                                            class="fa fa-id-card fa-xs"></i></span>
                                </div>
                                <input type="text" value="{{ $laporandetailpengerjaan->preorder->nama_barang }}"
                                    class="form-control"  name="nama_barang" id="nama_barang" readonly />
                            </div>
                        </div>
                    </div>

                    <div class="form-group row inputGroupContainer">
                        <label class="col-md-2 col-form-label font-weight-bold">Total Qty</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span style="background-color: #030f27" class="input-group-text"><i style="color: white"
                                            class="fa fa-id-card fa-xs"></i></span>
                                </div>
                                <input type="text" value="{{ $laporandetailpengerjaan->preorder->quantity }}"
                                    class="form-control"  name="quantity" id="quantity" readonly />
                            </div>
                        </div>
                    </div>

                    @if($laporandetailpengerjaan->preorder->photos->count() > 0)
                        <div class="form-group row inputGroupContainer">
                            <label class="col-md-2 col-form-label font-weight-bold">Foto</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="card w-100">
                                        <div class="card-body row">
                                            @foreach($laporandetailpengerjaan->preorder->photos as $photo)
                                            <div class="col-sm-3 p-0 m-1" style="width: 100px;">
                                                <a href="{{ $photo->url }}" target="_blank">
                                                    <img src="{{ asset($photo->url) }}" alt="Photo" style="object-fit: cover; width: 100%;" onerror="this.src=`{{ asset('error-image.png') }}`">
                                                </a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('laporandetailpengerjaan.index') }}" class="btn btn-warning px-4" role="button">
                            Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Progress
                </div>
                <div class="card-body">
                <table id="datatable" class="row-border hover table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>Tanggal Masuk</th>
                            <th>Tanggal Keluar</th>
                            <th>Nama Operator</th>
                            <th>Nama Mesin</th>
                            <th>Actual Qty</th>
                            <th>Keterangan Proses</th>
                            <th style="min-width: 300px;">Foto</th>
                            <th>Reject</th>
                            <th style="min-width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($progress as $p)
                            <tr>
                                <td>{{ $p->tanggal }}</td>
                                <td>{{ empty($p->tanggal_keluar) ? '-' : $p->tanggal_keluar }}</td>
                                <td>{{ $p->operator->nama }}</td>
                                <td>{{ $p->mesin->nama }}</td>
                                <td>{{ $p->qty }}</td>
                                <td>{{ $p->keterangan_proses }}</td>
                                <td> 
                                    @if($p->photos->count() > 0) 
                                    @foreach($p->photos as $photo)
                                    <a  href="{{ $photo->url }}" target="_blank"> 
                                        <image src="{{ $photo->url }}" width="100" height="100" style="object-fit: cover;" onerror="this.src=`{{ asset('error-image.png') }}`"> 
                                    </a> 
                                    @endforeach
                                    @else 
                                    <a target="_blank" href="{{ asset('no-image.svg') }}"> 
                                        <image src="{{ asset('no-image.svg') }}" width="100" height="100" style="object-fit: cover;"> 
                                    </a> 
                                    @endif</td>
                                <td>{{ empty($p->keterangan_reject) ? '-' : $p->keterangan_reject  }}</td>
                                <td>
                                    @if($p->mesin->is_gudang_finish == 1 && $p->is_approve == 0 && $p->is_reject == 0)
                                        <button class="btn btn-sm btn-success approve-button" data-id="{{$p->id}}">
                                            <i class="fa fa-check"></i> Approve
                                        </button>
                                    @endif
                                    @if($p->is_approve == 0 && (Auth::user()->role->id == 1 || strtoupper(Auth::user()->role->nama) == 'OWNER'))
                                    <form action="{{ route('laporandetailpengerjaan.destroy', $p->id) }}" class="mb-2" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger reject-button" type="submit">
                                            <i class="fa fa-times"></i> Remove
                                        </button>
                                    </form>
                                    @endif
                                    @if($p->is_approve == 0 && $p->is_reject == 0)
                                        <button class="btn btn-sm btn-danger reject-button mb-2" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_{{$p->id}}">
                                            <i class="fa fa-times"></i> Reject
                                        </button>

                                        @if($p->is_exclude_point == 0)
                                        <form action="{{ route('laporandetailpengerjaan.togglePoint', $p->id) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="type" value="EXCLUDE">
                                            <button class="btn btn-sm btn-danger reject-button" type="submit">
                                                <i class="fa fa-times"></i> Remove Point
                                            </button>
                                        </form>
                                        @else
                                        <form action="{{ route('laporandetailpengerjaan.togglePoint', $p->id) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="type" value="INCLUDE">
                                            <button class="btn btn-sm btn-success reject-button" type="submit">
                                                <i class="fa fa-check"></i> Undo Remove Point
                                            </button>
                                        </form>
                                        @endif

                                        <div class="modal fade" id="modal_{{$p->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Reject</h5>
                                                    </div>
                                                    <form action="{{ route('laporandetailpengerjaan.rejectAdmin') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id_history_surat" value="{{ $p->id }}">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <!-- Select Input with Label -->
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for="custom-select">Tipe Reject:</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-text" style="background-color: #030f27; color: white;"><i class="fas fa-globe" ></i></span>
                                                                            <select class="form-select" id="custom-select" name="tipe_reject">
                                                                                <option value="1" selected>Dapat Diperbaiki ( Operator mendapat poin )</option>
                                                                                <option value="2">Tidak Dapat Diperbaiki ( Operator tidak dapat poin )</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Textarea with Label -->
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for="keterangan">Keterangan:</label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text" style="background-color: #030f27; color: white;">
                                                                                    <i class="fas fa-comment"></i>
                                                                                </span>
                                                                            </div>
                                                                            <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
                                                                            @error('keterangan')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger" >Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>
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
        $('#datatable').DataTable({
            "autoWidth": false,
            "columnDefs": [{
                    "width": "10%",
                    "targets": 0
                },{
                    "width": "10%",
                    "targets": 1
                },
                {
                    "width": "13%",
                    "targets": 2
                },
                {
                    "width": "13%",
                    "targets": 3
                },
                {
                    "width": "15%",
                    "targets": 4
                },
                {
                    "width": "10%",
                    "targets": 5
                },
                {
                    "width": "15%",
                    "targets": 6
                },
                {
                    "width": "14%",
                    "targets": 7
                }
            ]
        });

        $('.approve-button').click(function () {
            var idSurat = $(this).data('id');

            var form = $('<form></form>');
            form.attr('method', 'POST');
            form.attr('action', "{{ route('laporandetailpengerjaan.approveAdmin') }}");

            var csrfField = $('<input type="hidden" name="_token" value="{{ csrf_token() }}">');
            var idSuratField = $('<input type="hidden" name="id_history_surat" value="' + idSurat + '">');

            form.append(csrfField);
            form.append(idSuratField);

            $('body').append(form);
            form.submit();
        });
    });

    </script>
@endpush
