<div>
    <div class="table-responsive">
        <table id="tabelHistorySurat" class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th style="min-width: 110px;">Nomor Order</th>
                    <th style="min-width: 150px;">Nama Customer</th>
                    <th style="min-width: 150px;">Nama Barang</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Keluar</th>
                    <th style="min-width: 150px;">Nama Operator</th>
                    <th style="min-width: 150px;">Nama Mesin</th>
                    <th style="min-width: 150px;">Keterangan</th>
                    <th style="min-width: 150px;">Keterangan Proses</th>
                    <th style="min-width: 100px;">Aksi</th>
                </tr>
                <tr>
                    <form action="">
                        <th><button type="submit" class="btn btn-info">Apply Filter</button></th>
                        <th><input class="form-control w-100" value="{{ $nomorOrderFilter }}" type="text" name="nomor_order_filter" placeholder="Search..."></th>
                        <th><input class="form-control w-100" value="{{ $namaCustomerFilter }}" type="text" name="nama_customer_filter" placeholder="Search..."></th>
                        <th><input class="form-control w-100" value="{{ $namaBarangFilter }}" type="text" name="nama_barang_filter" placeholder="Search..."></th>
                        <th>
                            <input type="date" name="tanggal_masuk_start_filter"
                                class="form-control" value="{{ $tanggalMasukStartFilter }}">
                            <input type="date" name="tanggal_masuk_end_filter" value="{{ $tanggalMasukEndFilter }}"
                                class="form-control">
                        </th>
                        <th>
                            <input type="date" value="{{ $tanggalKeluarStartFilter }}" name="tanggal_keluar_start_filter"
                                class="form-control">
                            <input type="date" value="{{ $tanggalKeluarEndFilter }}" name="tanggal_keluar_end_filter"
                                class="form-control">
                        </th>
                        <th><input class="form-control w-100" value="{{ $namaOperatorFilter }}" type="text" name="nama_operator_filter" placeholder="Search..."></th>
                        <th><input class="form-control w-100" value="{{ $namaMesinFilter }}" type="text" name="nama_mesin_filter" placeholder="Search..."></th>
                        <th><input class="form-control w-100" value="{{ $keteranganFilter }}" type="text" name="keterangan_filter" placeholder="Search..."></th>
                        <th><input class="form-control w-100" value="{{ $keteranganProsesFilter }}" type="text" name="keterangan_proses_filter" placeholder="Search..."></th>
                        <th></th>
                    </form>
                </tr>
            </thead>
            @foreach ($historysurat as $index => $surat)
                <tbody>
                    <tr>
                        <td scope="surat">{{ $index + $historysurat->firstItem() }}</td>
                        <td>{{ $surat->preorder?->nomor }}</td>
                        <td>{{ $surat->preorder?->customer }}</td>
                        <td>{{ $surat->preorder?->nama_barang }}</td>
                        <td>{{ date('d-m-Y', strtotime($surat->tanggal)) }}</td>
                        <?php
                            $isi="";
                            if ($surat->tanggal_keluar!=null)
                            {
                                $isi=date("d-m-Y",strtotime($surat->tanggal_keluar));
                            }
                            else {

                            }
                        ?>
                       <td>{{ $isi }}</td>
                        {{-- <td>{{ date('d-m-Y', strtotime($surat->tanggal_keluar)) }}</td> --}}
                        <td>{{ $surat->operator?->nama }}</td>
                        <td>{{ $surat->mesin?->nama }}</td>
                        <td>{{ $surat->keterangan }}</td>
                        <td>{{ $surat->keterangan_proses }}</td>
                        {{-- <button href="{{ route('mastermesin.destroy', ['mastermesin' => $mesin]) }}" type="button"
                    class="btn btn-danger"><i class="fas fa-trash"></i></button> --}}
                        <td style="text-align: center;">
                        <form class="d-inline" method="GET" action="{{ route('laporandetailpengerjaan.show', ['laporandetailpengerjaan' => $surat->id]) }}">
                            <button type="submit" class="btn btn-info">
                                <i class="fas fa-eye"></i>
                            </button>
                        </form>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
    {{ $historysurat->links() }}
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
        initAutocomplete("input[name=keterangan_filter]", "history_surats", "keterangan");
        initAutocomplete("input[name=keterangan_proses_filter]", "history_surats", "keterangan_proses");
    });
</script>
@endpush