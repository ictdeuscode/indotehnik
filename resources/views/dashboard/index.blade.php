@extends('layouts.dashboard')

@section('title')
    Halaman Utama Home
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('Home_home') }}
@endsection

@section('content')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"/> --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>


    <script defer src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <div class="row">
        <div class="col-md-12">
            <h2> Selamat Datang {{ Auth::user()->nama }} </h2>
        </div>
    </div>
    <br>
    @can('hasPermission', 'informasi_dashboard')
    <div class="card">
        <div class="card-body">
            <table id="tabelHome" class="row-border hover table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>No. Purchase-Order</th>
                        <th>Tanggal</th>
                        <th>Tanggal Keluar</th>
                        <th>Nama Mesin</th>
                        <th>Keterangan</th>
                        <th>Keterangan Proses</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $servername = 'localhost:3306';

                    if(env('DB_USED') == 'production')
                    {
                        $username = 'u1642703_indotehnik';
                        $password = 'indotehnik@deus.code';
                        $dbname = 'u1642703_indotehnik';
                    }
                    else if(env('DB_USED') == 'local')
                    {
                        $username = 'root';
                        $password = '';
                        $dbname = 'indotehnik';
                    }

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die('Connection failed: ' . $conn->connect_error);
                    }
                    $sql = 'SELECT * FROM history_surats';
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr><td>' . $row['no_surat'] . '</td><td>' . $row['tanggal'] . '</td><td>' . $row['tanggal_keluar'] . '</td><td>' . $row['nama_mesin'] . '</td><td>' . $row['keterangan'] . '</td><td>' . $row['keterangan_proses'] . '</td></tr>';
                        }
                    } else {
                        echo '0 results';
                    }
                    $conn->close();
                    
                    ?>
                </tbody>
            </table>

            <br>
            <br>
            <br>
            <h2> Belum ada Progress </h2>
            <table id="tabelHome2" class="row-border hover table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>No. Purchase-Order</th>
                        <th>Tanggal</th>
                        <th>Tanggal Keluar</th>
                        <th>Nama Mesin</th>
                        <th>Keterangan</th>
                        <th>Keterangan Proses</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < count($notif); $i++) {
                        // output data of each row
                        $row = (array) $notif[$i];
                        echo '<tr><td>' . $row['no_surat'] . '</td><td>' . $row['tanggal'] . '</td><td>' . $row['tanggal_keluar'] . '</td><td>' . $row['nama_mesin'] . '</td><td>' . $row['keterangan'] . '</td><td>' . $row['keterangan_proses'] . '</td></tr>';
                    }
                    ?>
                </tbody>
            </table>

            <br>
            <br>
            <br>
            <h2> Belum Dikirim </h2>
            <table id="tabelHome3" class="row-border hover table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>No. Purchase-Order</th>
                        <th>Nama Customer</th>
                        <th>Nama Barang</th>
                        <th>Tanggal</th>
                        <th>Tanggal Keluar</th>
                        <th>Nama Operator</th>
                        <th>Nama Mesin</th>
                        <th>Keterangan</th>
                        <th>Keterangan Proses</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($belumkirim as $data)
                   <tr>
                    <td>{{ $data->preorder?->nomor }}</td>
                    <td>{{ $data->preorder?->customer }}</td>
                    <td>{{ $data->preorder?->nama_barang }}</td>
                    <td>{{ $data->tanggal }}</td>
                    <td>{{ $data->tanggal_keluar }}</td>
                    <td>{{ $data->operator?->nama }}</td>
                    <td>{{ $data->mesin?->nama }}</td>
                    <td>{{ $data->keterangan }}</td>
                    <td>{{ $data->keterangan_proses }}</td>
                   </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endcan
    <script>
        $(document).ready(function() {
            $('#tabelHome').DataTable({
                "autoWidth": false,
                "columnDefs": [{
                        "width": "20%",
                        "targets": 0
                    },
                    {
                        "width": "25%",
                        "targets": 1
                    },
                    {
                        "width": "20%",
                        "targets": 2
                    },
                    {
                        "width": "25%",
                        "targets": 3
                    },
                    {
                        "width": "30%",
                        "targets": 4
                    },
                ],
                initComplete: function () {
                    var table = this;
                    var thead = $(table.api().table().header());

                    var searchRow = $('<tr>').appendTo(thead);

                    thead.find('th').each(function (index) {
                        var column = table.api().column(index);
                        var cell = $('<td>').appendTo(searchRow);
                        var input = $('<input type="text" placeholder="Search..."/>')
                            .on('keyup change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? val : '', true, false).draw();
                            });

                        cell.append(input);
                    });
                }
            });

            $('#tabelHome2').DataTable({
                "autoWidth": false,
                "columnDefs": [{
                        "width": "20%",
                        "targets": 0
                    },
                    {
                        "width": "25%",
                        "targets": 1
                    },
                    {
                        "width": "20%",
                        "targets": 2
                    },
                    {
                        "width": "25%",
                        "targets": 3
                    },
                    {
                        "width": "30%",
                        "targets": 4
                    },
                ],
                initComplete: function () {
                    var table = this;
                    var thead = $(table.api().table().header());

                    var searchRow = $('<tr>').appendTo(thead);

                    thead.find('th').each(function (index) {
                        var column = table.api().column(index);
                        var cell = $('<td>').appendTo(searchRow);
                        var input = $('<input type="text" placeholder="Search..."/>')
                            .on('keyup change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? val : '', true, false).draw();
                            });

                        cell.append(input);
                    });
                }
            });

            $('#tabelHome3').DataTable({
                "autoWidth": false,
                "columnDefs": [{
                        "width": "5%",
                        "targets": 0
                    },
                    {
                        "width": "15%",
                        "targets": 1
                    },
                    {
                        "width": "15%",
                        "targets": 2
                    },
                    {
                        "width": "10%",
                        "targets": 3
                    },
                    {
                        "width": "10%",
                        "targets": 4
                    },
                    {
                        "width": "10%",
                        "targets": 5
                    },
                    {
                        "width": "10%",
                        "targets": 6
                    },
                    {
                        "width": "10%",
                        "targets": 7
                    },
                    {
                        "width": "10%",
                        "targets": 8
                    },
                ],
                initComplete: function () {
                    var table = this;
                    var thead = $(table.api().table().header());

                    var searchRow = $('<tr>').appendTo(thead);

                    thead.find('th').each(function (index) {
                        var column = table.api().column(index);
                        var cell = $('<td>').appendTo(searchRow);
                        var input = $('<input type="text" placeholder="Search..."/>')
                            .on('keyup change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? val : '', true, false).draw();
                            });

                        cell.append(input);
                    });
                }
            });
        });
    </script>
@endsection
