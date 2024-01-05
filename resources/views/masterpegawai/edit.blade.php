@extends('layouts.dashboard')

@section('title')
    Edit Pegawai
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('edit_masterpegawai_title', $masterpegawai ) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('masterpegawai.update', ['masterpegawai' => $masterpegawai]) }}" method="POST">
                        <!-- title -->
                        @method('PUT')
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
                                        <input type="text" value="{{ old('kode', $masterpegawai->kode) }}"
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
                                        <input type="text" value="{{ old('nama', $masterpegawai->nama) }}"
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
                                <label class="col-md-2 col-form-label font-weight-bold">NPWP</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-id-card fa-xs"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('NPWP', $masterpegawai->NPWP) }}"
                                            class="form-control @error('NPWP') is-invalid @enderror" id="NPWP"
                                            name="NPWP" />
                                        @error('NPWP')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Alamat</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-map fa-xs"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('alamat', $masterpegawai->alamat) }}"
                                            class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                            name="alamat" />
                                        @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Provinsi</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-map-signs fa-sm"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('provinsi', $masterpegawai->provinsi) }}"
                                            class="form-control @error('provinsi') is-invalid @enderror" id="provinsi"
                                            name="provinsi" />
                                        @error('provinsi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Kota</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-building fa-sm"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('kota', $masterpegawai->kota) }}"
                                            class="form-control @error('kota') is-invalid @enderror" id="kota"
                                            name="kota" />
                                        @error('kota')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Kecamatan</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-home fa-xs"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('kecamatan', $masterpegawai->kecamatan) }}"
                                            class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan"
                                            name="kecamatan" />
                                        @error('kecamatan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Kelurahan</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-home fa-xs"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('kelurahan', $masterpegawai->kelurahan) }}"
                                            class="form-control @error('kelurahan') is-invalid @enderror" id="kelurahan"
                                            name="kelurahan" />
                                        @error('kelurahan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Kode Pos</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-envelope fa-sm"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('kode_pos', $masterpegawai->kode_pos) }}"
                                            class="form-control @error('kode_pos') is-invalid @enderror" id="kode_pos"
                                            name="kode_pos" />
                                        @error('kode_pos')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">No. Telp</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-phone-square"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('no_telp', $masterpegawai->no_telp) }}"
                                            class="form-control @error('no_telp') is-invalid @enderror" id="no_telp"
                                            name="no_telp" />
                                        @error('no_telp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Fax</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-fax fa-sm"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('fax', $masterpegawai->fax) }}"
                                            class="form-control @error('fax') is-invalid @enderror" id="fax"
                                            name="fax" />
                                        @error('fax')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Kontak Personal</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-mobile fa-lg"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('kontak', $masterpegawai->kontak) }}"
                                            class="form-control @error('kontak') is-invalid @enderror" id="kontak"
                                            name="kontak" />
                                        @error('kontak')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">E-mail</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-envelope fa-sm"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('email', $masterpegawai->email) }}"
                                            class="form-control @error('email') is-invalid @enderror" id="email"
                                            name="email" />
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Password</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-unlock-alt fa-sm"></i></span>
                                        </div>
                                        <input type="password" value="{{ old('password') }}"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            name="password" />
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Role</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-user fa-sm"></i></span>
                                        </div>
                                        <select class="form-control @error('role') is-invalid @enderror" id="role"
                                            name="role">
                                            <option value="">Pilih Role</option>
                                            @foreach($masterRole as $role)
                                            <option value="{{ $role->id }}" @if(old('role') == $role->id || $role->id == $masterpegawai->id_role) selected @endif>{{$role->nama}}</option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </fieldset>
                        <div class="float-right">
                            <a class="btn btn-warning px-4" href="{{ route('masterpegawai.index') }}">Back</a>
                            <button type="submit" class="btn btn-primary px-4">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection