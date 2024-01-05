<div>
    <div class="table-responsive">
        <table id="tabelMasterMesin" class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Mesin</th>
                    <th>Nama Mesin</th>
                    <th>Keterangan</th>
                    <th>Poin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            @foreach ($masterMesin as $index => $mesin)
                <tbody>
                    <tr>
                        <td scope="mesin">{{ $index + $masterMesin->firstItem() }}</td>
                        <td>{{ $mesin->kode }}</td>
                        <td>{{ $mesin->nama }}</td>
                        <td>{{ $mesin->keterangan }}</td>
                        <td>{{ $mesin->poin }}</td>

                        <td style="text-align: center;">
                            <form class="d-inline" action="{{ route('QRMasterMesin', $mesin->id) }}" role="button">
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-print"></i>
                                </button>
                            </form>
                            <form class="d-inline" action="{{ route('mastermesin.edit', ['mastermesin' => $mesin]) }}"
                                role="button">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </form>
                            {{-- <button href="{{ route('mastermesin.edit', ['mastermesin' => $mesin]) }}" type="button"
                        class="btn btn-warning"><i class="fas fa-edit"></i></button> --}}
                            <form class="d-inline"
                                action="{{ route('mastermesin.destroy', ['mastermesin' => $mesin]) }}" role="alert"
                                method="POST" alert-title="Peringatan" alert-text="Data Akan di Hapus"
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
    {{ $masterMesin->links() }}
</div>
