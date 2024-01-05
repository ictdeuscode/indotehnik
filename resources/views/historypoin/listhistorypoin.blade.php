@php
    $filter = '( Semua )';
    
    if (!empty($tanggal) && empty($tanggal2)) {
        $filter = '( ' . date('d M Y', strtotime($tanggal)) . ' - Sekarang ' . ' )';
    } elseif (empty($tanggal) && !empty($tanggal2)) {
        $filter = '( Sampai ' . date('d M Y', strtotime($tanggal2)) . ' )';
    } elseif (!empty($tanggal) && !empty($tanggal2)) {
        $filter = '( ' . date('d M Y', strtotime($tanggal)) . ' - ' . date('d M Y', strtotime($tanggal2)) . ' )';
    }
    
@endphp
<div>
    <div class="table-responsive">
        <table id="tabelHistoryPoin" class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Operator</th>
                    <th>Total Poin</th>
                    <th>Poin Didapat {{ $filter }}</th>
                    <th>Poin Ditukar {{ $filter }}</th>
                    <th>Aksi</th>
                </tr>
                <tr>
                    <form action="">
                        <input type="hidden" value="<?php echo $tanggal; ?>" name="startDateInput"
                            class="form-control">
                        <input type="hidden" value="<?php echo $tanggal2; ?>" name="endDateInput"
                            class="form-control">
                        <th><button type="submit" class="btn btn-info">Apply Filter</button></th>
                        <th><input class="form-control w-100" type="text" name="nama_operator_filter" value="{{ $namaOperatorFilter }}" placeholder="Search..."></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </form>
                </tr>
            </thead>
            <tbody id="listHistoryPoin">
                @foreach ($operators as $index => $operator)
                    <tr>
                        <td scope="operator">{{ $loop->iteration }}</td>
                        <td>{{ $operator->nama }}</td>
                        <td>{{ $operator->total_poin }}</td>
                        <td>{{ $operator->poin_didapat }}</td>
                        <td>{{ $operator->poin_ditukar }}</td>
                        <td>
                            <a href="{{ route('laporanpoinkaryawan.show', ['laporanpoinkaryawan' => $operator->id]) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#modalTukar_{{ $index }}">
                                <i class="fas fa-minus"></i>
                            </button>
                            <div class="modal fade" id="modalTukar_{{ $index }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tukar Poin</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('editpoin') }}" class="needs-validation" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                @if($operator->total_poin > 0)
                                                <input type="hidden" name="id_operator" value="{{$operator->id}}">
                                                <input type="hidden" name="action_type" value="TUKAR">
                                                <p>Masukkan nominal poin yang ingin ditukar (max :
                                                        {{ $operator->total_poin }})</p>
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
                                                                        name="poin" id="poin" min="1"
                                                                        max="{{ $operator->total_poin }}" required />
                                                                    @error('poin')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                                @else
                                                <div>
                                                    <p>Operator ini tidak memiliki poin untuk ditukar</p>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tutup</button>
                                                @if($operator->total_poin > 0)
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('javascript-internal')
<script src="{{ asset('js/autocomplete.js') }}"></script>
<script>
    $(document).ready(function(){
        initAutocomplete("input[name=nama_operator_filter]", "master_operators", "nama");
    });
</script>
@endpush
