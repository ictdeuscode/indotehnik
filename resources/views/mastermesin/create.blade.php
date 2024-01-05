@extends('layouts.dashboard')

@section('title')
    Tambah Mesin
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('tambah_mastermesin') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('mastermesin.store') }}" method="POST">
                        <!-- title -->
                        @csrf
                        <fieldset>
                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Kode</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-code fa-xs"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('kode') }}"
                                            class="form-control @error('kode') is-invalid @enderror" name="kode"
                                            id="kode" />
                                        @error('kode')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Nama</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-user-plus fa-xs"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('nama') }}"
                                            class="form-control @error('nama') is-invalid @enderror" id="nama"
                                            name="nama" />
                                        @error('nama')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Keterangan</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-map fa-xs"></i></span>
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
                                <label class="col-md-2 col-form-label font-weight-bold">Poin</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-user-plus fa-xs"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('poin') }}"
                                            class="form-control @error('poin') is-invalid @enderror" id="poin"
                                            name="poin" />
                                        @error('poin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Tandai sebagai gudang finish</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-check fa-xs"></i></span>
                                        </div>
                                        <input type="checkbox" value="1"
                                            class="form-control @error('is_gudang_finish') is-invalid @enderror" id="is_gudang_finish"
                                            name="is_gudang_finish" onclick="handleCheckboxChange('is_gudang_finish')" />
                                        @error('is_gudang_finish')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Tandai sebagai gudang kirim</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-check fa-xs"></i></span>
                                        </div>
                                        <input type="checkbox" value="1"
                                            class="form-control @error('is_gudang_kirim') is-invalid @enderror" id="is_gudang_kirim"
                                            name="is_gudang_kirim" onclick="handleCheckboxChange('is_gudang_kirim')" />
                                        @error('is_gudang_kirim')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </fieldset>
                        <div class="float-right">
                            <a class="btn btn-warning px-4" href="{{ route('mastermesin.index') }}">Back</a>
                            <button type="submit" class="btn btn-primary px-4">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript-external')
    <script>
        function handleCheckboxChange(checkboxId) {
            const checkboxes = ['is_gudang_kirim', 'is_gudang_finish'];

            checkboxes.forEach((checkbox) => {
                if (checkbox !== checkboxId && document.getElementById(checkboxId).checked) {
                    document.getElementById(checkbox).checked = false;
                }
            });
        }
    </script>
@endpush
