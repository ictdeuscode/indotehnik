@foreach ($historyoperator as $index => $operator)
    <tr>
        <td scope="operator">{{ $index + 1 }}</td>
        <td>{{ $operator->tanggal }}</td>
        <td>{{ $operator->nama_mesin }}</td>
        <td>{{ $operator->nama_barang }}</td>
        <td>{{ $operator->waktu }}</td>
        <td>{{ $operator->keterangan }}</td>
    </tr>
@endforeach

@dd($historyoperator) 