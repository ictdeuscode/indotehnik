<?php

use App\Http\Controllers\HistoryMesinController;
use App\Http\Controllers\HistoryOperatorController;
use App\Http\Controllers\HistorySuratController;
use App\Http\Controllers\HistoryGudangController;
use App\Http\Controllers\HistoryPoinController;
use App\Http\Controllers\LaporanRejectController;
use App\Http\Controllers\MasterPoinController;
use App\Http\Controllers\ScannController;
use App\Http\Controllers\ScannMesinController;
use App\Models\HistorySurat;
use Illuminate\Support\Facades\Route;
use App\Models\Scann;
use App\Models\ScannMesin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});






Route::post('/storeoperator', [\App\Http\Controllers\MasterQRController::class, 'storeoperator'])->name('storeoperator');

Route::post('/storemesin', [\App\Http\Controllers\MasterQRController::class, 'storemesin'])->name('storemesin');

Route::post('/storesurat', [\App\Http\Controllers\MasterQRController::class, 'storesurat'])->name('storesurat');

// Route::get('webcam', [WebcamController::class, 'index']);

// Route::post('webcam', [WebcamController::class, 'storegambar'])->name('webcam.capture');



Auth::routes([ 
    'register' => false 
]);

Route::group(['prefix' => 'dashboard', 'middleware' => ['web', 'auth']], function () {

    Route::post('/store', [\App\Http\Controllers\MasterQRController::class, 'store'])->name('store');

    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/downloadBackup', [\App\Http\Controllers\BackupController::class, 'downloadBackup'])->name('backup.downloadBackup');
    
    Route::post('SubmitQR', [\App\Http\Controllers\MasterQRController::class, 'store'])->name('SubmitQR');

    //route Master
    Route::resource('/masterrole', \App\Http\Controllers\MasterRoleController::class);
    Route::resource('/masterpermissionrole', \App\Http\Controllers\MasterPermissionRoleController::class);
    Route::post('/masterpermissionrole/togglepermission', [\App\Http\Controllers\MasterPermissionRoleController::class, 'togglePermission'])->name('masterpermissionrole.togglePermission');
    Route::post('/masterpermissionrole/togglecheckallpermission', [\App\Http\Controllers\MasterPermissionRoleController::class, 'toggleCheckAllPermission'])->name('masterpermissionrole.toggleCheckAllPermission');
    Route::resource('/masterpegawai', \App\Http\Controllers\MasterPegawaiController::class);
    Route::resource('/masteroperator', \App\Http\Controllers\MasterOperatorController::class);
    Route::resource('/mastermesin', \App\Http\Controllers\MasterMesinController::class);

    //Route::resource('/masterpreorder', \App\Http\Controllers\MasterPreorderController::class);

    // Customized routes
    Route::get('masternomororder', [\App\Http\Controllers\MasterPreorderController::class, 'index'])->name('masterpreorder.index'); // Customized index route
    Route::get('masternomororder/create', [\App\Http\Controllers\MasterPreorderController::class, 'create'])->name('masterpreorder.create'); // Customized create route
    Route::post('masternomororder', [\App\Http\Controllers\MasterPreorderController::class, 'store'])->name('masterpreorder.store'); // Customized store route
    Route::get('masternomororder/{masterpreorder}', [\App\Http\Controllers\MasterPreorderController::class, 'show'])->name('masterpreorder.show'); // Customized show route
    Route::get('masternomororder/{masterpreorder}/edit', [\App\Http\Controllers\MasterPreorderController::class, 'edit'])->name('masterpreorder.edit'); // Customized edit route
    Route::put('masternomororder/{masterpreorder}', [\App\Http\Controllers\MasterPreorderController::class, 'update'])->name('masterpreorder.update'); // Customized update route
    Route::delete('masternomororder/{masterpreorder}', [\App\Http\Controllers\MasterPreorderController::class, 'destroy'])->name('masterpreorder.destroy'); // Customized destroy route
    Route::delete('masternomororder/destroy/photo', [\App\Http\Controllers\MasterPreorderController::class, 'destroyPhoto'])->name('masterpreorder.destroyPhoto'); // Customized destroy route


    Route::resource('/masterQR', \App\Http\Controllers\MasterQRController::class);
    Route::resource('/masterpoin', \App\Http\Controllers\MasterPoinController::class);
    Route::resource('/scanQR', \App\Http\Controllers\MasterQRController::class);
    Route::resource('/scansuratorder', \App\Http\Controllers\MasterQRController::class);

    Route::resource('/masterpoin', \App\Http\Controllers\MasterPoinController::class);


    //route Master Pre-order import/export
    Route::post('/importpreorder', [\App\Http\Controllers\MasterPreorderController::class, 'importpreorder'])->name('importpreorder');
    Route::get('/exportpreorder', [\App\Http\Controllers\MasterPreorderController::class, 'exportpreorder'])->name('exportpreorder');
    Route::get('/printqr', [\App\Http\Controllers\MasterPreorderController::class, 'printqr'])->name('printqr');
    Route::get('/download-pdf', 'MasterPreorderController@downloadPDF');
    Route::get('/masterpreorder/qr-code', [\App\Http\Controllers\MasterPreorderController::class, 'qrCode'])->name('masterpreorder.qr-code');

    //route scan Page Camera
    //Route::get('/scansuratorder', [MasterPreorderController::class, 'handle'])->name('scansuratorder.handle');
    Route::get('/scanmesin', [\App\Http\Controllers\ScannMesinController::class, 'handle'])->name('scanmesin.handle');
    Route::get('/scanQR', [\App\Http\Controllers\ScannController::class, 'handle'])->name('scanQR.handle');

    Route::get('/scansuratorder', function () {
        return view('masterQR.scansuratorder', [
            'kode' => Scann::all()
        ]);
    });
    Route::get('/scanQR', function () {
        return view('masterQR.scanQR', [
            'kode' => Scann::all()
        ]);
    });
    Route::get('/scanmesin', function () {
        return view('masterQR.scanmesin', [
            'kode' => ScannMesin::all()
        ]);
    });


    Route::get('/index', function () {
        return view('masterQR.index', [
            'kode' => Scann::all()
        ]);
    });

    //route khusus QR
    Route::get('MesinQR/{id}', [\App\Http\Controllers\MasterMesinController::class, 'generate'])->name('QRMasterMesin');
    Route::get('PegawaiQR/{id}', [\App\Http\Controllers\MasterPegawaiController::class, 'generate'])->name('QRMasterPegawai');
    Route::get('OperatorQR/{id}', [\App\Http\Controllers\MasterOperatorController::class, 'generate'])->name('QRMasterOperator');
    Route::get('NomorOrderQR/{id}', [\App\Http\Controllers\MasterPreorderController::class, 'generate'])->name('QRMasterPreorder');

    //route Live Search Halaman QR
    Route::get('/autocomplete', [\App\Http\Controllers\AutoComplete::class, 'search'])->name('autocomplete');

    //route History Surat
    Route::resource('/laporandetailpengerjaan', \App\Http\Controllers\HistorySuratController::class);
    Route::post('/approveAdmin', [\App\Http\Controllers\HistorySuratController::class, 'approveAdmin'])->name('laporandetailpengerjaan.approveAdmin');
    Route::post('/rejectAdmin', [\App\Http\Controllers\HistorySuratController::class, 'rejectAdmin'])->name('laporandetailpengerjaan.rejectAdmin');
    Route::post('/exporthistorysurat', [\App\Http\Controllers\HistorySuratController::class, 'exporthistorysurat'])->name('exporthistorysurat');
    Route::post('/togglePoint/{id}', [\App\Http\Controllers\HistorySuratController::class, 'togglePoint'])->name('laporandetailpengerjaan.togglePoint');

    // route Laporan Reject
    Route::resource('/laporanreject', \App\Http\Controllers\LaporanRejectController::class);
    Route::post('/exportlaporanreject', [\App\Http\Controllers\LaporanRejectController::class, 'exportlaporanreject'])->name('exportlaporanreject');

    // route Laporan Reject Customer
    Route::resource('/laporanrejectcustomer', \App\Http\Controllers\LaporanRejectCustomerController::class);
    Route::post('/exportlaporanrejectcustomer', [\App\Http\Controllers\LaporanRejectCustomerController::class, 'exportlaporanrejectcustomer'])->name('exportlaporanrejectcustomer');

    //route History Operator
    Route::resource('/historyoperator', \App\Http\Controllers\HistoryOperatorController::class);
    Route::get('/exporthistoryoperator', [\App\Http\Controllers\HistoryOperatorController::class, 'exporthistoryoperator'])->name('exporthistoryoperator');

    //route History Mesin
    Route::resource('/historymesin', \App\Http\Controllers\HistoryMesinController::class);
    Route::get('/exporthistorymesin', [\App\Http\Controllers\HistoryMesinController::class, 'exporthistorymesin'])->name('exporthistorymesin');

    //route History Gudang
    Route::resource('/historygudang', \App\Http\Controllers\HistoryGudangController::class);
    Route::get('/exporthistorygudang', [\App\Http\Controllers\HistoryGudangController::class, 'exporthistorygudang'])->name('exporthistorygudang');

    //route History Poin
    Route::resource('/laporanpoinkaryawan', \App\Http\Controllers\HistoryPoinController::class);
    Route::post('/exporthistorypoin', [\App\Http\Controllers\HistoryPoinController::class, 'exporthistorypoin'])->name('exporthistorypoin');
    Route::post('/editpoin', [\App\Http\Controllers\HistoryPoinController::class, 'editpoin'])->name('editpoin');

    // route Laporan Stock
    Route::resource('/laporanstock', \App\Http\Controllers\LaporanStockController::class);
    Route::post('/exportlaporanstock', [\App\Http\Controllers\LaporanStockController::class, 'exportlaporanstock'])->name('exportlaporanstock');

    //autocomplete
    Route::get('/general/autocomplete', [\App\Http\Controllers\GeneralController::class, 'autocomplete']);
});
