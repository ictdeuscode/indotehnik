<div>
    <div class="table-responsive">
        <table id="tabelLaporanReject" class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Nomor Order</th>
                    <th>Nama Customer</th>
                    <th>Nama Barang</th>
                    <th>Keterangan Reject</th>
                    <th>Aksi</th>
                </tr>
                <tr>
                    <form action="">
                        <th><button type="submit" class="btn btn-info">Apply Filter</button></th>
                        <th>
                            <input type="date" name="tanggal_start_filter" value="{{ $tanggalStartFilter }}"
                                class="form-control">
                            <input type="date" name="tanggal_end_filter" value="{{ $tanggalEndFilter }}"
                                class="form-control">
                        </th>
                        <th><input class="form-control w-100" type="text" value="{{ $nomorOrderFilter }}" name="nomor_order_filter" placeholder="Search..."></th>
                        <th><input class="form-control w-100" type="text" value="{{ $namaCustomerFilter }}" name="nama_customer_filter" placeholder="Search..."></th>
                        <th><input class="form-control w-100" type="text" value="{{ $namaBarangFilter }}" name="nama_barang_filter" placeholder="Search..."></th>
                        <th><input class="form-control w-100" type="text" value="{{ $keteranganRejectFilter }}" name="keterangan_reject_filter" placeholder="Search..."></th>
                        <th></th>
                    </form>
                </tr>
            </thead>
            @foreach ($laporanrejectcustomer as $index => $laporan)
            <tbody>
                <tr>
                    <td scope="surat">{{ $index+1 }}</td>
                    <td>{{ date('d-m-Y', strtotime($laporan->created_at)) }}</td>
                    <td>{{ $laporan->preorder?->nomor }}</td>
                    <td>{{ $laporan->preorder?->customer }}</td>
                    <td>{{ $laporan->preorder?->nama_barang }}</td>
                    <td>{{ $laporan->keterangan_reject }}</td>
                    <td style="text-align: center;">
                        <form class="d-inline" action="{{ route('laporanrejectcustomer.edit', ['laporanrejectcustomer' => $laporan]) }}" role="button">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
    {{ $laporanrejectcustomer->links() }}
</div>

@push('javascript-internal')
<script src="{{ asset('js/autocomplete.js') }}"></script>
<script>
    $(document).ready(function(){
        initAutocomplete("input[name=nomor_order_filter]", "master_preorders", "nomor");
        initAutocomplete("input[name=nama_customer_filter]", "master_preorders", "customer");
        initAutocomplete("input[name=nama_barang_filter]", "master_preorders", "nama_barang");
        initAutocomplete("input[name=keterangan_reject_filter]", "history_surats", "keterangan_reject");
    });
</script>
@endpush