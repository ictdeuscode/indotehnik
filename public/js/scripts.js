$(document).ready(function() {
    $('#tabelMasterPegawai').DataTable({
        "columnDefs": [
            { "targets": -1, "className": 'dt-center' },
            { "width": "10%", "targets": 0 },
            { "width": "20%", "targets": 1 },
            { "width": "20%", "targets": 2 },
            { "width": "20%", "targets": 3 },
            { "width": "20%", "targets": 4 },
            { "width": "10%", "targets": 5 }
        ]
    });
});
$(document).ready(function() {
    $('#tabelMasterOperator').DataTable({
        "columnDefs": [
            { "targets": -1, "className": 'dt-center' },
            { "width": "5%", "targets": 0 },
            { "width": "20%", "targets": 1 },
            { "width": "20%", "targets": 2 },
            { "width": "20%", "targets": 3 },
            { "width": "20%", "targets": 4 },
            { "width": "20%", "targets": 5 }
        ]
    });
});
$(document).ready(function() {
    $('#tabelMasterMesin').DataTable({
        "columnDefs": [
            { "targets": -1, "className": 'dt-center' },
            { "width": "10%", "targets": 0 },
            { "width": "20%", "targets": 1 },
            { "width": "20%", "targets": 2 },
            { "width": "30%", "targets": 3 },
            { "width": "10%", "targets": 4 },
        ]
    });
});
$(document).ready(function() {
    $('#tabelQR').DataTable({
        "columnDefs": [
            { "targets": -1, "className": 'dt-center' },
            { "width": "5%", "targets": 0 },
            { "width": "15%", "targets": 1 },
            { "width": "20%", "targets": 2 },
            { "width": "5%", "targets": 3 },
            { "width": "5%", "targets": 4 },
            { "width": "20%", "targets": 5 },
            { "width": "5%", "targets": 6 }
        ]
    });
});
$(document).ready(function() {
    $('#tabelStokBarangA').DataTable({});
});
$(document).ready(function() {
    $('#tabelStokBarangB').DataTable({});
});
$(document).ready(function() {
    $('#tabelPembelianBarang').DataTable({
        "columnDefs": [
            { "targets": -1, "className": 'dt-center' },
            { "width": "10%", "targets": 0 },
            { "width": "20%", "targets": 1 },
            { "width": "15%", "targets": 2 },
            { "width": "10%", "targets": 3 },
            { "width": "10%", "targets": 4 },
            { "width": "5%", "targets": 5 },
            { "width": "10%", "targets": 6 },
            { "width": "10%", "targets": 7 },
            {}
        ]
    });
});
$(document).ready(function() {
    $('#tabelBarangMasuk').DataTable({
        "columnDefs": [
            { "targets": -1, "className": 'dt-center' },
            { "width": "30%", "targets": 0 },
            { "width": "30%", "targets": 1 },
            { "width": "20%", "targets": 2 },
            { "width": "10%", "targets": 3 },
            {}
        ]
    });
});
$(document).ready(function() {
    $('#tabelBarangKeluar').DataTable({
        "columnDefs": [
            { "targets": -1, "className": 'dt-center' },
            { "width": "30%", "targets": 0 },
            { "width": "30%", "targets": 1 },
            { "width": "20%", "targets": 2 },
            { "width": "10%", "targets": 3 }
        ]
    });
});
$(document).ready(function() {
    $('#tabelSuratJalan').DataTable({
        "columnDefs": [
            { "targets": -1, "className": 'dt-center' },
            { "targets": -2, "className": 'dt-center' },
            { "width": "5%", "targets": 0 },
            { "width": "5%", "targets": 1 },
            { "width": "5%", "targets": 2 },
            { "width": "10%", "targets": 3 },
            { "width": "10%", "targets": 4 },
            { "width": "10%", "targets": 5 },
            { "width": "10%", "targets": 6 },
            { "width": "10%", "targets": 7 }
        ]
    });
});
$(document).ready(function() {
    $('#tabelFormDesain').DataTable({
        "columnDefs": [
            { "targets": -1, "className": 'dt-center' },
            { "width": "10%", "targets": 0 },
            { "width": "35%", "targets": 1 },
            { "width": "35%", "targets": 2 },
            { "width": "10%", "targets": 3 },
        ]
    });
});
$('#myModal').on('shown.bs.modal', function() {
    $('#myInput').trigger('focus')
})