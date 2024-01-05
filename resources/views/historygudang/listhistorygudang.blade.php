<div>
    <div class="table-responsive">
        <table id="tabelHistorySurat" class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>No. Purchase-Order</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Keluar</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            @foreach ($historysurat as $index => $surat)
                <tbody>
                    <tr>
                        <td scope="surat">{{ $index + $historysurat->firstItem() }}</td>
                        <td>{{ $surat->no_surat }}</td>
                        <td>{{ date('d-m-Y', strtotime($surat->tanggal)) }}</td>
                        <?php
                        $isi = '';
                        if ($surat->tanggal_keluar != null) {
                            $isi = date('d-m-Y', strtotime($surat->tanggal_keluar));
                        } else {
                        }
                        ?>
                        <td>{{ $isi }}</td>
                        <td>{{ $surat->keterangan_proses }}</td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
    {{ $historysurat->links() }}
</div>
