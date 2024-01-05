<?php // routes/breadcrumbs.php

// Home
Breadcrumbs::for('Home', function ( $trail) {
    $trail->push('Home', route('dashboard.index'));
});

Breadcrumbs::for('Home_home', function ( $trail) {
    $trail->parent('Home');
    $trail->push('Home', '#');
});

//-------------------------------------------------------Master Role-------------------------------------------
//Master Role > Index
Breadcrumbs::for('masterrole', function ( $trail) {
    $trail->parent('Home');
    $trail->push('Master Role', route('masterrole.index'));
});

//Master Role > Tambah
Breadcrumbs::for('tambah_masterrole', function ( $trail) {
    $trail->parent('masterrole');
    $trail->push('Tambah role', route('masterrole.create'));
});

//Master Role > Edit
Breadcrumbs::for('edit_masterrole', function ($trail, $role) {
    $trail->parent('masterrole');
    $trail->push('Edit role', route('masterrole.edit', ['masterrole' => $role]));
});

// Dahsboard > Master role -> edit -> title
Breadcrumbs::for('edit_masterrole_title', function ($trail, $role) {
    $trail->parent('edit_masterrole', $role);
    $trail->push($role->nama, route('masterrole.edit', ['masterrole' => $role]));
});

// Dahsboard > Master role -> show
Breadcrumbs::for('detail_masterrole', function ($trail, $role) {
    $trail->parent('masterrole');
    $trail->push('Detail role', route('masterrole.show', ['masterrole' => $role]));
});

// Dahsboard > Master role -> show -> title
Breadcrumbs::for('detail_masterrole_title', function ($trail, $role) {
    $trail->parent('detail_masterrole', $role);
    $trail->push($role->nama, route('masterrole.show', ['masterrole' => $role]));
});

//-------------------------------------------------------Master Permission Role -------------------------------------------
//Master Permission Role > Index
Breadcrumbs::for('masterpermissionrole', function ( $trail) {
    $trail->parent('Home');
    $trail->push('Master Role', route('masterpermissionrole.index'));
});

//-------------------------------------------------------Master Mesin-------------------------------------------
//Master Mesin > Index
Breadcrumbs::for('mastermesin', function ( $trail) {
    $trail->parent('Home');
    $trail->push('Master Mesin', route('mastermesin.index'));
});

//Master Mesin > Tambah
Breadcrumbs::for('tambah_mastermesin', function ( $trail) {
    $trail->parent('mastermesin');
    $trail->push('Tambah Mesin', route('mastermesin.create'));
});

//Master Mesin > Edit
Breadcrumbs::for('edit_mastermesin', function ($trail, $mesin) {
    $trail->parent('mastermesin');
    $trail->push('Edit mesin', route('mastermesin.edit', ['mastermesin' => $mesin]));
});

// Dahsboard > Master mesin -> edit -> title
Breadcrumbs::for('edit_mastermesin_title', function ($trail, $mesin) {
    $trail->parent('edit_mastermesin', $mesin);
    $trail->push($mesin->nama, route('mastermesin.edit', ['mastermesin' => $mesin]));
});

// Dahsboard > Master mesin -> show
Breadcrumbs::for('detail_mastermesin', function ($trail, $mesin) {
    $trail->parent('mastermesin');
    $trail->push('Detail mesin', route('mastermesin.show', ['mastermesin' => $mesin]));
});

// Dahsboard > Master mesin -> show -> title
Breadcrumbs::for('detail_mastermesin_title', function ($trail, $mesin) {
    $trail->parent('detail_mastermesin', $mesin);
    $trail->push($mesin->nama, route('mastermesin.show', ['mastermesin' => $mesin]));
});

// {{ route('QRMasterMesin', $mesin->id) }}
//Master Mesin > QR

//-------------------------------------------------------Master Operator-------------------------------------------
//Master Operator > Index
Breadcrumbs::for('masteroperator', function ( $trail) {
    $trail->parent('Home');
    $trail->push('Master Operator', route('masteroperator.index'));
});

//Master operator > Tambah
Breadcrumbs::for('tambah_masteroperator', function ( $trail) {
    $trail->parent('masteroperator');
    $trail->push('Tambah Operator', route('masteroperator.create'));
});

//Master operator > Edit
Breadcrumbs::for('edit_masteroperator', function ($trail, $operator) {
    $trail->parent('masteroperator');
    $trail->push('Edit Operator', route('masteroperator.edit', ['masteroperator' => $operator]));
});

// Dahsboard > Master operator -> edit -> title
Breadcrumbs::for('edit_masteroperator_title', function ($trail, $operator) {
    $trail->parent('edit_masteroperator', $operator);
    $trail->push($operator->nama, route('masteroperator.edit', ['masteroperator' => $operator]));
});

// Dahsboard > Master operator -> show
Breadcrumbs::for('detail_masteroperator', function ($trail, $operator) {
    $trail->parent('masteroperator');
    $trail->push('Detail Operator', route('masteroperator.show', ['masteroperator' => $operator]));
});

// Dahsboard > Master operator -> show -> title
Breadcrumbs::for('detail_masteroperator_title', function ($trail, $operator) {
    $trail->parent('detail_masteroperator', $operator);
    $trail->push($operator->nama, route('masteroperator.show', ['masteroperator' => $operator]));
});


//-------------------------------------------------------Master Pegawai-------------------------------------------
//Master pegawai > Index
Breadcrumbs::for('masterpegawai', function ( $trail) {
    $trail->parent('Home');
    $trail->push('Master Pegawai', route('masterpegawai.index'));
});

//Master pegawai > Tambah
Breadcrumbs::for('tambah_masterpegawai', function ( $trail) {
    $trail->parent('masterpegawai');
    $trail->push('Tambah Pegawai', route('masterpegawai.create'));
});

//Master pegawai > Edit
Breadcrumbs::for('edit_masterpegawai', function ($trail, $pegawai) {
    $trail->parent('masterpegawai');
    $trail->push('Edit Pegawai', route('masterpegawai.edit', ['masterpegawai' => $pegawai]));
});

// Dahsboard > Master pegawai -> edit -> title
Breadcrumbs::for('edit_masterpegawai_title', function ($trail, $pegawai) {
    $trail->parent('edit_masterpegawai', $pegawai);
    $trail->push($pegawai->nama, route('masterpegawai.edit', ['masterpegawai' => $pegawai]));
});

// Dahsboard > Master pegawai -> show
Breadcrumbs::for('detail_masterpegawai', function ($trail, $pegawai) {
    $trail->parent('masterpegawai');
    $trail->push('Detail Pegawai', route('masterpegawai.show', ['masterpegawai' => $pegawai]));
});

// Dahsboard > Master pegawai -> show -> title
Breadcrumbs::for('detail_masterpegawai_title', function ($trail, $pegawai) {
    $trail->parent('detail_masterpegawai', $pegawai);
    $trail->push($pegawai->nama, route('masterpegawai.show', ['masterpegawai' => $pegawai]));
});


//-------------------------------------------------------Master Poin-------------------------------------------
//Master pegawai > Index
Breadcrumbs::for('masterpoin', function ( $trail) {
    $trail->parent('Home');
    $trail->push('Master Poin', route('masterpoin.index'));
});

//Master pegawai > Edit
Breadcrumbs::for('edit_masterpoin', function ($trail, $poin) {
    $trail->parent('masterpoin');
    $trail->push('Edit Poin', route('masterpoin.edit', ['masterpoin' => $poin]));
});

// Dahsboard > Master pegawai -> edit -> title
Breadcrumbs::for('edit_masterpoin_title', function ($trail, $poin) {
    $trail->parent('edit_masterpoin', $poin);
    $trail->push($poin->nama, route('masterpoin.edit', ['masterpoin' => $poin]));
});

// Dahsboard > Master pegawai -> show
Breadcrumbs::for('detail_masterpoin', function ($trail, $poin) {
    $trail->parent('masterpoin');
    $trail->push('Detail Poin', route('masterpoin.show', ['masterpoin' => $poin]));
});

// Dahsboard > Master pegawai -> show -> title
Breadcrumbs::for('detail_masterpoin_title', function ($trail, $poin) {
    $trail->parent('detail_masterpoin', $poin);
    $trail->push($poin->nama, route('masterpoin.show', ['masterpoin' => $poin]));
});



//-------------------------------------------------------Master Pre-Order -------------------------------------------
//Master pegawai > Index
Breadcrumbs::for('masterpreorder', function ( $trail) {
    $trail->parent('Home');
    $trail->push('Master Nomor Order', route('masterpreorder.index'));
});

//Master pegawai > Tambah
Breadcrumbs::for('tambah_masterpreorder', function ( $trail) {
    $trail->parent('masterpreorder');
    $trail->push('Tambah Nomor Order', route('masterpreorder.create'));
});

//Master pegawai > Edit
Breadcrumbs::for('edit_masterpreorder', function ($trail, $preorder) {
    $trail->parent('masterpreorder');
    $trail->push('Edit Nomor Order', route('masterpreorder.edit', ['masterpreorder' => $preorder]));
});

// Dahsboard > Master pegawai -> edit -> title
Breadcrumbs::for('edit_masterpreorder_title', function ($trail, $preorder) {
    $trail->parent('edit_masterpreorder', $preorder);
    $trail->push($preorder->customer, route('masterpreorder.edit', ['masterpreorder' => $preorder]));
});

// Dahsboard > Master pegawai -> show
Breadcrumbs::for('detail_masterpreorder', function ($trail, $preorder) {
    $trail->parent('masterpreorder');
    $trail->push('Detail Purchase-Order', route('masterpreorder.show', ['masterpreorder' => $preorder]));
});

// Dahsboard > Master pegawai -> show -> title
Breadcrumbs::for('detail_masterpreorder_title', function ($trail, $preorder) {
    $trail->parent('detail_masterpreorder', $preorder);
    $trail->push($preorder->customer, route('masterpreorder.show', ['masterpreorder' => $preorder]));
});


//-------------------------------------------------Master QR-------------------------------------------------------
//Master Mesin > QR
Breadcrumbs::for('QR_mastermesin', function ($trail, $mesin) {
    $trail->parent('mastermesin');
    $trail->push('QR Mesin', route('mastermesin.index', ['mastermesin' => $mesin]));
});

//Master Operator > QR
Breadcrumbs::for('QR_masteroperator', function ($trail, $operator) {
    $trail->parent('masteroperator');
    $trail->push('QR Operator', route('masteroperator.index', ['masteroperator' => $operator]));
});

//Master Pegawai > QR
Breadcrumbs::for('QR_masterpegawai', function ($trail, $pegawai) {
    $trail->parent('masterpegawai');
    $trail->push('QR Pegawai', route('masterpegawai.index', ['masterpegawai' => $pegawai]));
});

//Master pre-order > QR
Breadcrumbs::for('QR_masterpreorder', function ($trail, $masterpreorder) {
    $trail->parent('masterpreorder');
    $trail->push('QR Nomor Order', route('masterpreorder.index', ['masterpreorder' => $masterpreorder]));
});


//---------------------------------------------------------Halaman QR---------------------------------------
Breadcrumbs::for('masterQR', function ( $trail) {
    $trail->parent('Home');
    $trail->push('QR Page', route('masterQR.index'));
});

//---------------------------------------------------------History All---------------------------------------
Breadcrumbs::for('historymesin', function ( $trail) {
    $trail->parent('Home');
    $trail->push('History Mesin', route('historymesin.index'));
});

Breadcrumbs::for('historyoperator', function ( $trail) {
    $trail->parent('Home');
    $trail->push('History Operator', route('historyoperator.index'));
});

Breadcrumbs::for('historysurat', function ( $trail) {
    $trail->parent('Home');
    $trail->push('Laporan Detail Pengerjaan', route('laporandetailpengerjaan.index'));
});

Breadcrumbs::for('detail_historysurat', function ($trail, $historysurat) {
    $trail->parent('historysurat');
    $trail->push('Detail Pengerjaan', route('laporandetailpengerjaan.show', ['laporandetailpengerjaan' => $historysurat]));
});

Breadcrumbs::for('detail_historysurat_title', function ($trail, $historysurat) {
    $trail->parent('detail_historysurat', $historysurat);
    $trail->push($historysurat->no_surat, route('laporandetailpengerjaan.show', ['laporandetailpengerjaan' => $historysurat]));
});

Breadcrumbs::for('laporanreject', function ( $trail) {
    $trail->parent('Home');
    $trail->push('Laporan Reject', route('laporanreject.index'));
});

Breadcrumbs::for('laporanrejectcustomer', function ( $trail) {
    $trail->parent('Home');
    $trail->push('Laporan Reject Customer', route('laporanrejectcustomer.index'));
});

Breadcrumbs::for('tambah_laporanrejectcustomer', function ( $trail) {
    $trail->parent('laporanrejectcustomer');
    $trail->push('Tambah Reject Customer', route('laporanrejectcustomer.create'));
});

Breadcrumbs::for('edit_laporanrejectcustomer', function ($trail, $laporanrejectcustomer) {
    $trail->parent('laporanrejectcustomer');
    $trail->push('Edit Reject Customer', route('laporanrejectcustomer.edit', ['laporanrejectcustomer' => $laporanrejectcustomer]));
});

Breadcrumbs::for('laporanstock', function ( $trail) {
    $trail->parent('Home');
    $trail->push('Laporan Stock', route('laporanstock.index'));
});

Breadcrumbs::for('edit_laporanstock', function ($trail, $laporanstock) {
    $trail->parent('laporanstock');
    $trail->push('Edit Laporan Stock', route('laporanstock.edit', ['laporanstock' => $laporanstock]));
});

Breadcrumbs::for('historygudang', function ( $trail) {
    $trail->parent('Home');
    $trail->push('History Gudang', route('historygudang.index'));
});

Breadcrumbs::for('historypoin', function ( $trail) {
    $trail->parent('Home');
    $trail->push('Laporan Poin Karyawan', route('laporanpoinkaryawan.index'));
});

Breadcrumbs::for('detail_historypoin', function ($trail, $history_poin) {
    $trail->parent('historypoin');
    $trail->push('Detail Poin Karyawan', route('laporanpoinkaryawan.show', ['laporanpoinkaryawan' => $history_poin]));
});

Breadcrumbs::for('detail_historypoin_title', function ($trail, $history_poin) {
    $trail->parent('detail_historypoin', $history_poin);
    $trail->push($history_poin->nama, route('laporanpoinkaryawan.show', ['laporanpoinkaryawan' => $history_poin]));
});