<div>
    <div class="table-responsive">
        <table id="tabelMasterPoin" class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Operator</th>
                    <th>Jenis</th>
                    <th>Poin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            @foreach ($masterPoin as $index => $poin)
            <tbody>
                <tr>
                    <td scope="poin">{{ $index + $masterPoin->firstItem() }}</td>
                    <td>{{ $poin->kode }}</td>
                    <td>{{ $poin->nama }}</td>
                    <td>{{ $poin->keterangan }}</td>
                    <td>{{ $poin->scan_count }}</td>
                    <td style="text-align: center;">
                        <form class="d-inline" action="{{ route('masterpoin.edit', ['masterpoin' => $poin]) }}"
                            role="button">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </button>
                        </form>
                        {{-- <button href="{{ route('mastermesin.edit', ['mastermesin' => $mesin]) }}" type="button"
                        class="btn btn-warning"><i class="fas fa-edit"></i></button> --}}
                        <form class="d-inline" action="{{ route('masterpoin.destroy', ['masterpoin' => $mesin]) }}"
                            role="alert" method="POST" alert-title="Peringatan" alert-text="Data Akan di Hapus"
                            alert-btn-cancel="Batal" alert-btn-yes="Setuju">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        {{-- <button href="{{ route('mastermesin.destroy', ['mastermesin' => $mesin]) }}" type="button"
                        class="btn btn-danger"><i class="fas fa-trash"></i></button> --}}
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
    {{ $masterPoin->links() }}
</div>
