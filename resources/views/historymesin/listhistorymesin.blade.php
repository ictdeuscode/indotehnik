<div>
    <div class="table-responsive">
        <table id="tabelHistorySurat" class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    {{-- <th>No. Purchase-Order</th> --}}
                    <th>No. Purchase-Order</th>
                    {{-- <th>Tanggal Keluar</th> --}}
                    <th>Nama Mesin</th>
                    <th>Nama Operator</th>
                    <th>Tanggal</th>
                    {{-- <th>Keterangan Proses</th> --}}
                    {{-- <th>Aksi</th> --}}
                </tr>
            </thead>
            @foreach ($historysurat as $index => $surat)
                <tbody>
                    <tr>
                        <td scope="surat">{{ $index + $historysurat->firstItem() }}</td>
                        {{-- <td>{{ $surat->no_surat }}</td> --}}
                        
                        <td>{{ $surat->no_surat }}</td>
                        <?php
                            $isi="";
                            if ($surat->tanggal_keluar!=null)
                            {
                                $isi=date("d-m-Y",strtotime($surat->tanggal_keluar));
                            }
                            else {

                            }
                        ?>
                        <td>{{ $surat->nama_mesin }}</td>
                        <td>{{ $surat->nama_operator }}</td>
                        <td>{{ date('d-m-Y', strtotime($surat->tanggal)) }}</td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
    {{ $historysurat->links() }}
</div>
