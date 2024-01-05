<div>
    <div class="table-responsive">
        <table id="tabelMasterPegawai" class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode pegawai</th>
                    <th>Nama pegawai</th>
                    <th>Role pegawai</th>
                    <th>NPWP</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            @foreach ($masterPegawai as $index => $pegawai)
                <tbody>
                    <tr>
                        <td scope="pegawai">{{ $index + $masterPegawai->firstItem() }}</td>
                        <td>{{ $pegawai->kode }}</td>
                        <td>{{ $pegawai->nama }}</td>
                        <td>{{ $pegawai->role->nama ?? '-' }}</td>
                        <td>{{ $pegawai->NPWP }}</td>
                        <td>{{ $pegawai->alamat }}</td>
                        <td style="text-align: center;">
                            <!-- <form class="d-inline" action="{{ route('QRMasterPegawai', $pegawai->id) }}" role="button">
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-print"></i>
                                </button>
                            </form> -->
                            <form class="d-inline"
                                action="{{ route('masterpegawai.edit', ['masterpegawai' => $pegawai]) }}"
                                role="button">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </form>
                            {{-- <button href="{{ route('masterpegawai.edit', ['masterpegawai' => $pegawai]) }}" type="button"
                            class="btn btn-warning"><i class="fas fa-edit"></i></button> --}}
                            <form class="d-inline"
                                action="{{ route('masterpegawai.destroy', ['masterpegawai' => $pegawai]) }}"
                                role="alert" method="POST" alert-title="Peringatan" alert-text="Data Akan di Hapus"
                                alert-btn-cancel="Batal" alert-btn-yes="Setuju">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            {{-- <button href="{{ route('masterpegawai.destroy', ['masterpegawai' => $pegawai]) }}" type="button"
                            class="btn btn-danger"><i class="fas fa-trash"></i></button> --}}
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
    {{ $masterPegawai->links() }}
</div>

