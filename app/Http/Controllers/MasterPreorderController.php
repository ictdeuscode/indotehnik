<?php

namespace App\Http\Controllers;

use App\Imports\PreorderImport;
use App\Exports\PreorderExport;
use App\Models\MasterPreorder;
use App\Models\MasterPreorderPhoto;
use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Writer;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use Database\Seeders\MasterPreorderTableSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use MasterPreorderTable;
use PhpParser\Node\Stmt\TryCatch;

class MasterPreorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'master_nomor_order'), 403);

        $tanggal = $request->input("startDateInput");
        $tanggal2 = $request->input("endDateInput");
        $startTanggal = "1990-05-05 00:00:00";
        if ($tanggal != null) {
            $startTanggal = $tanggal . " 00:00:00";
        }
        $endTanggal = "2050-05-05 00:00:00";
        if ($tanggal2 != null) {
            $endTanggal = $tanggal2 . " 23:59:59";
        }
        $masterPreorder = MasterPreorder::where("tanggal", ">=", $startTanggal)->where("tanggal", "<=", $endTanggal)->paginate(20);

        //echo $startTanggal;
        return view('masterpreorder.index', compact('masterPreorder', 'tanggal', 'tanggal2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('hasPermission', 'master_nomor_order'), 403);

        return view('masterpreorder.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request)
    {
    }
    public function store(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'master_nomor_order'), 403);

        $validator = Validator::make(
            $request->all(),
            [
                'nomor' => 'required',
                'nama_barang' => 'required',
                'tanggal' => 'required',
                'customer' => 'required',
                'quantity' => 'required',
                'satuan' => 'required',
                'explanation' => 'required',
                'keterangan' => 'required',
                'is_stock' => 'required',
            ],
        );

        // dd("Proses Insert data", $request->all());
        try {
            $masterPreorder = MasterPreorder::create([
                'nomor' => $request->nomor,
                'nama_barang' => $request->nama_barang,
                'tanggal' => $request->tanggal,
                'customer' => $request->customer,
                'quantity' => $request->quantity,
                'satuan' => $request->satuan,
                'explanation' => $request->explanation,
                'keterangan' => $request->keterangan,
                'is_stock' => $request->is_stock ?? 0
            ]);
            
            if($request->foto)
            {
                foreach($request->foto as $foto)
                {
                    $filedata = $foto;
                    $filename = $this->generateRandomString(5) . ".jpg";
    
                    $s3Path = 'foto-nomor-order/';
    
                    $result = Storage::disk('s3')->put($s3Path . $filename, $filedata, 'public');
    
                    $master_preorder_photo = new MasterPreorderPhoto();
                    $master_preorder_photo->id_master_preorder = $masterPreorder->id;
                    $master_preorder_photo->url = Storage::disk('s3')->url($s3Path . $filename);
                    $master_preorder_photo->save();
                }
            }

            Alert::success('Input Data', 'Input Data Berhasil');
            return redirect()->route('masterpreorder.index');
        } catch (\Throwable $th) {
            Alert::error('Input Data', 'Ada Bagian yang Masih Kosong');
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
    }

    public function printqr(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'master_nomor_order'), 403);

        $qr = $request->session()->get("imported");
        //dd($qr);
        $qr_codes = [];
        for ($i = 0; $i < count($qr); $i++) {
            $temp = $qr[$i];
            $renderer = new Png();
            $renderer->setWidth(200);
            $renderer->setHeight(200);
            $writer = new Writer($renderer);
            $qr_code = $writer->writeString($temp . ""); // Use the "nomor" field instead of "code"
            $qr_codes[] = [
                'code' => $temp . "", // Use the "nomor" field instead of "code"
                'qr_code' => 'data:image/png;base64,' . base64_encode($qr_code)
            ];
        }

        // Display the QR codes on the page
        return view('masterpreorder.qr-code', compact('qr_codes'));
    }

    public function importpreorder(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'master_nomor_order'), 403);

        //cek jenis file
        $validator = Validator::make(
            $request->all(),
            [
                'file' => 'required|mimes:csv,xls,xlsx'
            ],
        );

        //try
        {
            PreorderImport::$imported = [];
            // menangkap file excel
            $file = $request->file('file');
            // membuat nama file unik
            $nama_file = rand() . $file->getClientOriginalName();
            // upload ke folder file_siswa di dalam folder public
            $file->move('master_preorders', $nama_file);
            // import data
            Excel::import(new PreorderImport, public_path('/master_preorders/' . $nama_file));
            $request->session()->put("imported", PreorderImport::$imported);

            //Yes masuk ke halaman Print QR, no balik ke masterpreorder.index
?>
            <script>
                var data = confirm("Apakah anda ingin mencetak qr code?");
                if (data) {
                    window.location = "<?php echo url("dashboard/printqr"); ?>";
                } else {
                    window.location = "<?php echo route("masterpreorder.index"); ?>";
                }
            </script>
<?php

            /*
            Alert::question('Print QR Codes', 'Apakah mau Print QR Code hasil Import Excel?')
                    ->showConfirmButton('Yes', '#3085d6')
                    ->showCancelButton('No')
                    ->html();*/
            //;
            //         // ->html()
            //         // ->persistent(true)
            //         // ->confirmButtonText('Download')
            //         // ->cancelButtonText('Cancel')
            //         // ->confirmButtonClass('btn btn-primary')
            //         // ->cancelButtonClass('btn btn-danger')
            //         ->footer('<a href="' . route('downloadqr') . '">' . $pdf_file_name . '</a>');
            //         // ->confirmButtonColor('#3085d6');
            // ambil data import
            //$preorders = MasterPreorder::all();

            // cek isi data
            // if ($data->count() > 0) {
            //     // buat halaman print QR
            //     $pdf = Pdf::loadView('masterpreorder/qr-code', compact('data'));
            //     // simpan bentuk PDF
            //     $pdf_file_name = 'preorder-qr-codes.pdf';
            //     $pdf->save(storage_path('app/public/' . $pdf_file_name));

            //     Alert::question('Print QR Codes', 'Apakah mau Print QR Code hasil Import Excel?')
            //         ->showConfirmButton('Yes', '#3085d6')
            //         ->showCancelButton('No')
            //         // ->html()
            //         // ->persistent(true)
            //         // ->confirmButtonText('Download')
            //         // ->cancelButtonText('Cancel')
            //         // ->confirmButtonClass('btn btn-primary')
            //         // ->cancelButtonClass('btn btn-danger')
            //         ->footer('<a href="' . route('downloadqr') . '">' . $pdf_file_name . '</a>');
            //         // ->confirmButtonColor('#3085d6');
            // } else {
            //     Alert::success('Input Data', 'Input Data Berhasil')->persistent(true)->autoClose(3000);
            // }
            /*
            if ($preorders->count() > 0) {
                $qr_codes = [];

                // Generate QR codes for each item in the data
                foreach ($preorders as $item) {
                    $renderer = new Png();
                    $renderer->setWidth(200);
                    $renderer->setHeight(200);
                    $writer = new Writer($renderer);
                    $qr_code = $writer->writeString($item->nomor); // Use the "nomor" field instead of "code"
                    $qr_codes[] = [
                        'code' => $item->nomor, // Use the "nomor" field instead of "code"
                        'qr_code' => 'data:image/png;base64,' . base64_encode($qr_code)
                    ];
                }

                // Display the QR codes on the page
                return view('masterpreorder.qr-code', compact('qr_codes'));*/
            //}

            //return redirect()->route('masterpreorder.index');
        }
        //catch (\Throwable $th) {
        //Alert::error('Input Data', 'Ada Bagian yang Masih Kosong atau Sudah Ada Data yang Sama' . $th);
        //return redirect()->back()->withInput($request->all())->withErrors($validator);
        //}
    }

    public function exportpreorder()
    {
        abort_unless(Gate::allows('hasPermission', 'master_nomor_order'), 403);

        return Excel::download(new PreorderExport, 'DataNomorOrder.xlsx');
    }

    public function generate($masterpreorder)
    {
        abort_unless(Gate::allows('hasPermission', 'master_nomor_order'), 403);

        $data = MasterPreorder::findOrFail($masterpreorder);
        $masterPreorderQR = QrCode::format('png')->size(200)->generate($data->nomor);
        return view('masterpreorder.PreorderQR', compact('masterPreorderQR', 'data'));
    }

    public function downloadPDF()
    {
        abort_unless(Gate::allows('hasPermission', 'master_nomor_order'), 403);

        // Fetch the data for the view
        $qr_codes = [];

        // Create a new instance of Dompdf
        $dompdf = new Dompdf();

        // Render the Blade view as HTML
        $html = view('qr-codes')->with(compact('qr_codes'))->render();

        // Load the HTML into Dompdf
        $dompdf->loadHtml($html);

        // Set the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF
        $dompdf->render();

        // Download the PDF
        return $dompdf->stream('qr-codes.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterPreorder  $masterPreorder
     * @return \Illuminate\Http\Response
     */
    public function show(MasterPreorder $masterpreorder)
    {
        abort_unless(Gate::allows('hasPermission', 'master_nomor_order'), 403);

        return view('masterpreorder.show', compact('masterpreorder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterPreorder  $masterPreorder
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterPreorder $masterpreorder)
    {
        abort_unless(Gate::allows('hasPermission', 'master_nomor_order'), 403);

        return view('masterpreorder.edit', compact('masterpreorder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterPreorder  $masterPreorder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterPreorder $masterpreorder)
    {
        abort_unless(Gate::allows('hasPermission', 'master_nomor_order'), 403);

        $validator = Validator::make(
            $request->all(),
            [
                // 'nomor' => 'required',
                'nama_barang' => 'required',
                'tanggal' => 'required',
                'customer' => 'required',
                'quantity' => 'required',
                'satuan' => 'required',
                'explanation' => 'required',
                'keterangan' => 'required',
                'is_stock' => 'required'
            ],
        );
        // dd("Proses Insert data", $request->all());
        try {
            $masterpreorder->update([
                // 'nomor' => $request->nomor,
                'nama_barang' => $request->nama_barang,
                'tanggal' => $request->tanggal,
                'customer' => $request->customer,
                'quantity' => $request->quantity,
                'satuan' => $request->satuan,
                'explanation' => $request->explanation,
                'keterangan' => $request->keterangan,
                'is_stock' => $request->is_stock ?? 0
            ]);

            if($request->foto)
            {
                foreach($request->foto as $foto)
                {
                    $filedata = $foto;
                    $filename = $this->generateRandomString(5) . ".jpg";
    
                    $s3Path = 'foto-nomor-order/';
    
                    $result = Storage::disk('s3')->put($s3Path . $filename, $filedata, 'public');
    
                    $master_preorder_photo = new MasterPreorderPhoto();
                    $master_preorder_photo->id_master_preorder = $masterpreorder->id;
                    $master_preorder_photo->url = Storage::disk('s3')->url($s3Path . $filename);
                    $master_preorder_photo->save();
                }
            }

            Alert::success('Edit Data', 'Edit Data Berhasil');
            return redirect()->route('masterpreorder.index');
        } catch (\Throwable $th) {
            Alert::error('Edit Data', 'Ada Bagian yang Masih Kosong');
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterPreorder  $masterPreorder
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterPreorder $masterpreorder)
    {
        abort_unless(Gate::allows('hasPermission', 'master_nomor_order'), 403);
        
        try {
            $masterpreorder->delete();
            Alert::success('Hapus Data', 'Hapus Data Berhasil');
        } catch (\Throwable $th) {
            Alert::error('Hapus Data', 'Hapus Data Gagal');
        }

        return redirect()->back();
    }

    public function destroyPhoto(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'master_nomor_order'), 403);
        
        try {
            $id_photo = $request->id_photo;
            MasterPreorderPhoto::find($id_photo)->delete();
            Alert::success('Hapus Foto', 'Hapus Foto Berhasil');
        } catch (\Throwable $th) {
            Alert::error('Hapus Foto', 'Hapus Foto Gagal');
        }

        return redirect()->back();
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
