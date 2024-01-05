<div>
    <div class="table-responsive">
        <table id="tabelLaporanReject" class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nomor Order</th>
                    <th>Nama Customer</th>
                    <th>Nama Barang</th>
                    <th>Tanggal Masuk</th>
                    <th>Nama Operator</th>
                    <th>Nama Mesin</th>
                    <th>Tipe Reject</th>
                    <th>Keterangan Reject</th>
                </tr>
                <tr>
                    <form action="">
                        <th><button type="submit" class="btn btn-info">Apply Filter</button></th>
                        <th><input class="form-control w-100" type="text" value="{{ $nomorOrderFilter }}" name="nomor_order_filter" placeholder="Search..."></th>
                        <th><input class="form-control w-100" type="text" value="{{ $namaCustomerFilter }}" name="nama_customer_filter" placeholder="Search..."></th>
                        <th><input class="form-control w-100" type="text" value="{{ $namaBarangFilter }}" name="nama_barang_filter" placeholder="Search..."></th>
                        <th>
                            <input type="date" name="tanggal_start_filter" value="{{ $tanggalStartFilter }}"
                                class="form-control">
                            <input type="date" name="tanggal_end_filter" value="{{ $tanggalEndFilter }}"
                                class="form-control">
                        </th>
                        <th><input class="form-control w-100" type="text" value="{{ $namaOperatorFilter }}" name="nama_operator_filter" placeholder="Search..."></th>
                        <th><input class="form-control w-100" type="text" value="{{ $namaMesinFilter }}" name="nama_mesin_filter" placeholder="Search..."></th>
                        <th>
                            <select class="form-select form-control w-100" id="custom-select" name="tipe_reject_filter">
                                <option value="0" selected>Pilih</option>
                                <option value="1" @if($tipeRejectFilter == 1) selected @endif>Dapat Diperbaiki ( Operator mendapat poin )</option>
                                <option value="2" @if($tipeRejectFilter == 2) selected @endif>Tidak Dapat Diperbaiki ( Operator tidak dapat poin )</option>
                            </select>
                        </th>
                        <th><input class="form-control w-100" type="text" value="{{ $keteranganRejectFilter }}" name="keterangan_reject_filter" placeholder="Search..."></th>
                    </form>
                </tr>
            </thead>
            @foreach ($laporanreject as $index => $laporan)
                <tbody>
                    <tr>
                        <td scope="surat">{{ $index+1 }}</td>
                        <td>{{ $laporan->preorder?->nomor }}</td>
                        <td>{{ $laporan->preorder?->customer }}</td>
                        <td>{{ $laporan->preorder?->nama_barang }}</td>
                        <td>{{ date('d-m-Y', strtotime($laporan->tanggal)) }}</td>
                        <td>{{ $laporan->operator?->nama }}</td>
                        <td>{{ $laporan->mesin?->nama }}</td>
                        <td>{{ $laporan->tipe_reject == 1 ? 'Dapat diperbaiki ( Operator dapat poin )' : 'Tidak dapat diperbaiki ( Operator tidak dapat poin )' }}</td>
                        <td>{{ $laporan->keterangan_reject }}</td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
    {{ $laporanreject->links() }}
</div>

@push('javascript-internal')
<script src="{{ asset('js/autocomplete.js') }}"></script>
<script>
    $(document).ready(function(){
        initAutocomplete("input[name=nomor_order_filter]", "master_preorders", "nomor");
        initAutocomplete("input[name=nama_customer_filter]", "master_preorders", "customer");
        initAutocomplete("input[name=nama_barang_filter]", "master_preorders", "nama_barang");
        initAutocomplete("input[name=nama_operator_filter]", "master_operators", "nama");
        initAutocomplete("input[name=nama_mesin_filter]", "master_mesins", "nama");
        initAutocomplete("input[name=keterangan_reject_filter]", "history_surats", "keterangan_reject");
    });
</script>
@endpush
