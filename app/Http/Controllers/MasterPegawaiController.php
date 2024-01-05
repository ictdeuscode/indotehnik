<?php

namespace App\Http\Controllers;

use App\Models\MasterPegawai;
use App\Models\MasterRole;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Database\Seeders\masterPegawaiTableSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use MasterPegawaiTable;
use PhpParser\Node\Stmt\TryCatch;

class MasterPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('hasPermission', 'master_pegawai'), 403);

        $masterPegawai = MasterPegawai::where('id', '!=', 1)->paginate(5);
        return view('masterpegawai.index', compact('masterPegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('hasPermission', 'master_pegawai'), 403);

        $masterRole = MasterRole::all();

        return view('masterpegawai.create', compact('masterRole'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'master_pegawai'), 403);

        $validator = Validator::make(
            $request->all(),
            [
                'kode' => 'required',
                'nama' => 'required',
                'NPWP' => 'required',
                'alamat' => 'required',
                'provinsi' => 'required',
                'kota' => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',
                'kode_pos' => 'required',
                'no_telp' => 'required',
                'fax' => 'required',
                'email' => 'required',
                'kontak' => 'required',
                'password' => 'required',
                'role' => 'required',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // dd("Proses Insert data", $request->all());
        try {
            $masterPegawai = MasterPegawai::create([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'NPWP' => $request->NPWP,
                'alamat' => $request->alamat,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'kode_pos' => $request->kode_pos,
                'no_telp' => $request->no_telp,
                'fax' => $request->fax,
                'email' => $request->email,
                'kontak' => $request->kontak,
                'password' => Hash::make($request->password),
                'id_role' => $request->role
            ]);
            Alert::success('Input Data', 'Input Data Berhasil');
            return redirect()->route('masterpegawai.index');
        } catch (\Throwable $th) {
            Alert::error('Input Data', 'Ada Bagian yang Masih Kosong');
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
    }

    public function generate($masterpegawai)
    {
        abort_unless(Gate::allows('hasPermission', 'master_pegawai'), 403);

        $data = MasterPegawai::findOrFail($masterpegawai);
        $masterPegawaiQR = QrCode::format('png')->size(200)->generate($data->kode);
        return view('masterpegawai.PegawaiQR', compact('masterPegawaiQR', 'data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterPegawai  $masterPegawai
     * @return \Illuminate\Http\Response
     */
    public function show(MasterPegawai $masterpegawai)
    {
        abort_unless(Gate::allows('hasPermission', 'master_pegawai'), 403);

        return view('masterpegawai.show', compact('masterpegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterPegawai  $masterPegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterPegawai $masterpegawai)
    {
        abort_unless(Gate::allows('hasPermission', 'master_pegawai'), 403);

        $masterRole = MasterRole::all();

        return view('masterpegawai.edit', compact('masterpegawai', 'masterRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterPegawai  $masterPegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterPegawai $masterpegawai)
    {
        abort_unless(Gate::allows('hasPermission', 'master_pegawai'), 403);

        $validator = Validator::make(
            $request->all(),
            [
                'kode' => 'required',
                'nama' => 'required',
                'NPWP' => 'required',
                'alamat' => 'required',
                'provinsi' => 'required',
                'kota' => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',
                'kode_pos' => 'required',
                'no_telp' => 'required',
                'fax' => 'required',
                'email' => 'required',
                'kontak' => 'required',
                'password' => 'nullable',
                'role' => 'required',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // dd("Proses Insert data", $request->all());
        try {
            $masterpegawai->update([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'NPWP' => $request->NPWP,
                'alamat' => $request->alamat,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'kode_pos' => $request->kode_pos,
                'no_telp' => $request->no_telp,
                'fax' => $request->fax,
                'email' => $request->email,
                'kontak' => $request->kontak,
                'id_role' => $request->role
            ]);

            if($request->password)
            {
                $masterpegawai->update(['password' => Hash::make($request->password)]);
            }
            
            Alert::success('Edit Data', 'Edit Data Berhasil');

            if($masterpegawai->id == Auth::user()->id)
            {
                return redirect('/dashboard');
            }
            else
            {
                return redirect()->route('masterpegawai.index');
            }
        } catch (\Throwable $th) {
            Alert::error('Edit Data', 'Ada Bagian yang Masih Kosong');
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterPegawai  $masterPegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterPegawai $masterpegawai)
    {
        abort_unless(Gate::allows('hasPermission', 'master_pegawai'), 403);
        
        try {
            $masterpegawai->delete();
            Alert::success('Hapus Data', 'Hapus Data Berhasil');
        } catch (\Throwable $th) {
            Alert::error('Hapus Data', 'Hapus Data Gagal');
        }

        return redirect()->back();
    }
}
