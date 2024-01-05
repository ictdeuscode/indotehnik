<?php

namespace App\Http\Controllers;

use App\Models\MasterPegawai;
use App\Models\MasterRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class MasterRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('hasPermission', 'master_role'), 403);

        $masterRole = MasterRole::where('id', '!=', 1)->paginate(5);
        return view('masterrole.index', compact('masterRole'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('hasPermission', 'master_role'), 403);

        return view('masterrole.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'master_role'), 403);

        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required',
            ],
        );

        // dd("Proses Insert data", $request->all());
        try {
            $masterRole = MasterRole::create([
                'nama' => $request->nama,
            ]);
            Alert::success('Input Data', 'Input Data Berhasil');
            return redirect()->route('masterrole.index');
        } catch (\Throwable $th) {
            Alert::error('Input Data', 'Ada Bagian yang Masih Kosong');
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterRole $masterrole)
    {
        abort_unless(Gate::allows('hasPermission', 'master_role'), 403);

        return view('masterrole.edit', compact('masterrole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterRole $masterrole)
    {
        abort_unless(Gate::allows('hasPermission', 'master_role'), 403);

        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required',
            ],
        );

        // dd("Proses Insert data", $request->all());
        try {
            $masterrole->update([
                'nama' => $request->nama,
            ]);
            Alert::success('Edit Data', 'Edit Data Berhasil');
            return redirect()->route('masterrole.index');
        } catch (\Throwable $th) {
            Alert::error('Edit Data', 'Ada Bagian yang Masih Kosong');
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterRole $masterrole)
    {
        abort_unless(Gate::allows('hasPermission', 'master_role'), 403);
        
        try {
            MasterPegawai::where('id_role', $masterrole->id)->update(['id_role' => null]);
            $masterrole->delete();
            Alert::success('Hapus Data', 'Hapus Data Berhasil');
        } catch (\Throwable $th) {
            Alert::error('Hapus Data', 'Hapus Data Gagal');
        }

        return redirect()->back();
    }
}
