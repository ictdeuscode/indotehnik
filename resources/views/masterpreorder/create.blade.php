@extends('layouts.dashboard')

@section('title')
    Tambah Nomor Order
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('tambah_masterpreorder') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('masterpreorder.store') }}" method="POST" enctype="multipart/form-data">
                        <!-- title -->
                        @csrf
                        <fieldset>
                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Nomor Order</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-code fa-xs"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('nomor') }}"
                                            class="form-control @error('nomor') is-invalid @enderror" name="nomor"
                                            id="nomor" />
                                        @error('nomor')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Tanggal</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-user-plus fa-xs"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('tanggal') }}"
                                            class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                                            name="tanggal" onfocus="(this.type='date')" />
                                        @error('tanggal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Nama Barang</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-id-card fa-xs"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('nama_barang') }}"
                                            class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang"
                                            name="nama_barang" />
                                        @error('nama_barang')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Customer</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-id-card fa-xs"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('customer') }}"
                                            class="form-control @error('customer') is-invalid @enderror" id="customer"
                                            name="customer" />
                                        @error('customer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Quantity</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-map fa-xs"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('quantity') }}"
                                            class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                                            name="quantity" />
                                        @error('quantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Satuan</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-map-signs fa-sm"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('satuan') }}"
                                            class="form-control @error('satuan') is-invalid @enderror" id="satuan"
                                            name="satuan" />
                                        @error('satuan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Explanation</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-building fa-sm"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('explanation') }}"
                                            class="form-control @error('explanation') is-invalid @enderror"
                                            id="explanation" name="explanation" />
                                        @error('explanation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Keterangan Job</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-home fa-xs"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('keterangan') }}"
                                            class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                            name="keterangan" />
                                        @error('keterangan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Tandai sebagai stock</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-check fa-xs"></i></span>
                                        </div>
                                        <input type="checkbox" value="1"
                                            class="form-control @error('is_stock') is-invalid @enderror" id="is_stock"
                                            name="is_stock" />
                                        @error('is_stock')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Foto</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-image fa-xs"></i></span>
                                        </div>
                                        <input type="file"
                                            class="form-control @error('foto') is-invalid @enderror" id="foto"
                                            name="foto[]" multiple/>
                                    </div>
                                </div>
                            </div>

                        </fieldset>
                        <div class="float-right">
                            <a class="btn btn-warning px-4" href="{{ route('masterpreorder.index') }}">Back</a>
                            <button type="submit" class="btn btn-primary px-4">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="/public/js/jquery-1.11.2.min.js"></script>

<script type="text/javascript">
    $(function() {
        $(document).ready(function() {
            $('#tanggal').datepicker({
                dateFormat: 'yy/mm/dd',
            });
        });
    });
</script>
