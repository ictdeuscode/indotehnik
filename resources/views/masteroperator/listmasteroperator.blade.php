<div>
    <div class="table-responsive">
        <table id="tabelMasterOperator" class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Operator</th>
                    <th>Nama Operator</th>
                    <th>NPWP</th>
                    <th>Jenis Operator</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            @foreach ($masterOperator as $index => $operator)
                <tbody>
                    <tr>
                        <td scope="operator">{{ $index + $masterOperator->firstItem() }}</td>
                        <td>{{ $operator->kode }}</td>
                        <td>{{ $operator->nama }}</td>
                        <td>{{ $operator->NPWP }}</td>
                        <td>{{ $operator->jenis_operator }}</td>
                        <td style="text-align: center;">
                            <form class="d-inline" action="{{ route('QRMasterOperator', $operator->id) }}" role="button">
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-print"></i>
                                </button>
                            </form>
                            <form class="d-inline"
                                action="{{ route('masteroperator.edit', ['masteroperator' => $operator]) }}"
                                role="button">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </form>
                            {{-- <button href="{{ route('masteroperator.edit', ['masteroperator' => $operator]) }}"
                        type="button"
                        class="btn btn-warning"><i class="fas fa-edit"></i></button> --}}
                            <form class="d-inline"
                                action="{{ route('masteroperator.destroy', ['masteroperator' => $operator]) }}"
                                role="alert" method="POST" alert-title="Peringatan" alert-text="Data Akan di Hapus"
                                alert-btn-cancel="Batal" alert-btn-yes="Setuju">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            {{-- <button href="{{ route('masteroperator.destroy', ['masteroperator' => $operator]) }}"
                        type="button"
                        class="btn btn-danger"><i class="fas fa-trash"></i></button> --}}
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
    {{ $masterOperator->links() }}
</div>
