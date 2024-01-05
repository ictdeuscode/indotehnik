<?php

namespace App\Http\Controllers;

use App\Models\MasterPermission;
use App\Models\MasterRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class MasterPermissionRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('hasPermission', 'master_permission_role'), 403);

        $masterRole = MasterRole::where('id', '!=', 1)->get();
        $masterPermission = MasterPermission::all();
        return view('masterpermissionrole.index', compact('masterRole', 'masterPermission'));
    }

    public function togglePermission(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'master_permission_role'), 403);

        $idRole = $request->id_role;
        $idPermission = $request->id_permission;

        $role = MasterRole::find($idRole);

        if ($role->permissions->contains($idPermission)) {
            $role->permissions()->detach($idPermission);
            $message = 'Permission berhasil dihapus';
        } else {
            $role->permissions()->attach($idPermission);
            $message = 'Permission berhasil ditambahkan';
        }

        return response()->json(['status' => true, 'message' => $message]);
    }

    public function toggleCheckAllPermission(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'master_permission_role'), 403);

        $id_role = $request->id_role;
        $action = $request->action;
        $permissions = MasterPermission::all();

        foreach($permissions as $permission)
        {
            if($action == 'add')
            {
                $add = DB::table('permission_role')->insert(['id_permission' => $permission->id, 'id_role' => $id_role]);
            }else if($action == 'remove')
            {
                $remove = DB::table('permission_role')->where('id_permission', $permission->id)->where('id_role', $id_role)->delete();
            }   
        }

        return response()->json(['status' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
