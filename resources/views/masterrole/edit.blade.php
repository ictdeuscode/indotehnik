@extends('layouts.dashboard')

@section('title')
    Edit Role
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('edit_masterrole_title', $masterrole ) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('masterrole.update', ['masterrole' => $masterrole]) }}" method="POST">
                        <!-- title -->
                        @method('PUT')
                        @csrf
                        <fieldset>
                            <div class="form-group row inputGroupContainer">
                                <label class="col-md-2 col-form-label font-weight-bold">Nama</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">$</span> --}}
                                            <span style="background-color: #030f27" class="input-group-text"><i
                                                    style="color: white" class="fa fa-user-plus fa-xs"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('nama', $masterrole->nama) }}"
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
                        </fieldset>
                        <div class="float-right">
                            <a class="btn btn-warning px-4" href="{{ route('masterrole.index') }}">Back</a>
                            <button type="submit" class="btn btn-primary px-4">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection