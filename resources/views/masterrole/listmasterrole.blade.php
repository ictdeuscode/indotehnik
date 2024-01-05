<div>
    <div class="table-responsive">
        <table id="tabelMasterRole" class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            @foreach ($masterRole as $index => $role)
                <tbody>
                    <tr>
                        <td scope="pegawai">{{ $index+1 }}</td>
                        <td>{{ $role->nama }}</td>
                        <td style="text-align: center;">
                            <form class="d-inline"
                                action="{{ route('masterrole.edit', ['masterrole' => $role]) }}"
                                role="button">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </form>
                            <form class="d-inline"
                                action="{{ route('masterrole.destroy', ['masterrole' => $role]) }}"
                                role="alert" method="POST" alert-title="Peringatan" alert-text="Data Akan di Hapus"
                                alert-btn-cancel="Batal" alert-btn-yes="Setuju">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
    {{ $masterRole->links() }}
</div>

