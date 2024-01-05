<div>
    <div class="table-responsive">
        @if (session()->has('success'))
            <div class="aler alert success" role="alert">
                {{session('success')}}
            </div>
        @endif
        <table id="tabelMasterPreOrder" class="table table-bordered">
            <thead>
                <tr>
                    <th>No. Order</th>
                    <th>Tanggal Order</th>
                    <th>Nama Barang</th>
                    <th>Customer</th>
                    <th>Quantity</th>
                    <th>Satuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            @foreach ($masterPreorder as $index => $preorder)
                <tbody>
                    <tr>
                        {{-- <td scope="pegawai">{{ $index + $masterPreorder->firstItem() }}</td> --}}
                        <td>{{ $preorder->nomor }}</td>
                        <td>{{ date('d-m-Y', strtotime($preorder->tanggal)) }}</td>
                        <td>{{ $preorder->nama_barang }}</td>
                        <td>{{ $preorder->customer }}</td>
                        <td>{{ $preorder->quantity }}</td>
                        <td>{{ $preorder->satuan }}</td>
                        <td style="text-align: center;">
                            <form class="d-inline" action="{{ route('QRMasterPreorder', $preorder->id) }}" role="button">
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-print"></i>
                                </button>
                            </form>
                            <form class="d-inline"
                                action="{{ route('masterpreorder.edit', ['masterpreorder' => $preorder]) }}"
                                role="button">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </form>
                            {{-- <button href="{{ route('masterpegawai.edit', ['masterpegawai' => $pegawai]) }}" type="button"
                            class="btn btn-warning"><i class="fas fa-edit"></i></button> --}}
                            <form class="d-inline"
                                action="{{ route('masterpreorder.destroy', ['masterpreorder' => $preorder]) }}"
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
    {{ $masterPreorder->links() }}
</div>
