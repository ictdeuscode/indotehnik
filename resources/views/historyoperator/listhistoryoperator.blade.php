<div>
    <div class="table-responsive">
        <table id="tabelHistorySurat" class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    {{-- <th>No. Purchase-Order</th> --}}
                    <th>Tanggal</th>
                    {{-- <th>Tanggal Keluar</th> --}}
                    <th>Nama Mesin</th>
                    <th>Waktu</th>
                    <th>Keterangan</th>
                    {{-- <th>Keterangan Proses</th> --}}
                    {{-- <th>Aksi</th> --}}
                </tr>
            </thead>
            @foreach ($historysurat as $index => $surat)
                <tbody>
                    <tr>
                        <td scope="surat">{{ $index + $historysurat->firstItem() }}</td>
                        {{-- <td>{{ $surat->no_surat }}</td> --}}
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
                       {{-- <td>{{ $isi }}</td> --}}
                        {{-- <td>{{ date('d-m-Y', strtotime($surat->tanggal_keluar)) }}</td> --}}
                        <td>{{ $surat->nama_mesin }}</td>
                        <td>{{ date("h:i:s") }}</td>
                        <td>{{ $surat->keterangan_proses }}</td>
                        {{-- <td>{{ $surat->keterangan_proses }}</td> --}}
                        {{-- <button href="{{ route('mastermesin.destroy', ['mastermesin' => $mesin]) }}" type="button"
                    class="btn btn-danger"><i class="fas fa-trash"></i></button> --}}
                        {{-- <td style="text-align: center;">
                            <form class="d-inline" action="{{ route('historysurat.show', ['historysurat' => $surat]) }}"
                                role="button">
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </form>
                        </td> --}}
                        {{-- <form class="d-inline"
                            action="{{ route('historysurat.show', ['historysurat' => $surat]) }}" role="button">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </button>
                        </form> --}}
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
    {{ $historysurat->links() }}
</div>
