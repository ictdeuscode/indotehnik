<div>
    <div class="table-responsive">
        <table id="tabelLaporanReject" class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Nomor Order</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
                <tr>
                    <form action="">
                        <th><button type="submit" class="btn btn-info">Apply Filter</button></th>
                        <th>
                            <input type="date" value="{{ $tanggalStartFilter }}" name="tanggal_start_filter"
                                class="form-control">
                            <input type="date" value="{{ $tanggalEndFilter }}" name="tanggal_end_filter"
                                class="form-control">
                        </th>
                        <th><input class="form-control w-100" type="text" value="{{ $nomorOrderFilter }}" name="nomor_order_filter" placeholder="Search..."></th>
                        <th><input class="form-control w-100" type="text" value="{{ $namaBarangFilter }}" name="nama_barang_filter" placeholder="Search..."></th>
                        <th><input class="form-control w-100" type="number" value="{{ $qtyFilter }}" name="qty_filter" placeholder="Search..."></th>
                        <th><input class="form-control w-100" type="text" value="{{ $keteranganFilter }}" name="keterangan_filter" placeholder="Search..."></th>
                        <th></th>
                    </form>
                </tr>
            </thead>
            @foreach ($laporanstock as $index => $laporan)
            <tbody>
                <tr>
                    <td scope="surat">{{ $index+1 }}</td>
                    <td>{{ date('d-m-Y', strtotime($laporan->created_at)) }}</td>
                    <td>{{ $laporan->preorder?->nomor }}</td>
                    <td>{{ $laporan->preorder?->nama_barang }}</td>
                    <td>{{ $laporan->qty }}</td>
                    <td>{{ $laporan->keterangan }}</td>
                    <td style="text-align: center;">
                        <form class="d-inline" action="{{ route('laporanstock.edit', ['laporanstock' => $laporan]) }}" role="button">
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
    {{ $laporanstock->links() }}
</div>

@push('javascript-internal')
<script src="{{ asset('js/autocomplete.js') }}"></script>
<script>
    $(document).ready(function(){
        initAutocomplete("input[name=nomor_order_filter]", "master_preorders", "nomor");
        initAutocomplete("input[name=nama_barang_filter]", "master_preorders", "nama_barang");
        initAutocomplete("input[name=keterangan_filter]", "laporan_stock", "keterangan");
    });
</script>
@endpush