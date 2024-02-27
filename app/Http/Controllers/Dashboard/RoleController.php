<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\AdminsDataTable;
use App\DataTables\RolesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cpanel\Roles\StoreRequest;
use App\Models\Roles;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $page = "role";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RolesDataTable $dataTable)
    {
        $this->authorize($this->page.'_list');
        return $dataTable->render('pages.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {

        if ($request->has('role_id')) {
            $this->authorize($this->page.'_update');
        } else {
            $this->authorize($this->page.'_create');
        }

        \DB::transaction(function () use ($request){
           $role = Roles::updateOrCreate(['id' => $request->input('role_id')], [
                'role' => $request->input('role')
            ]);
           $role->permissions()->sync($request->permissions);
        });

        return response()->json([
            'status' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roles = Roles::find($id);

        if (!empty(count($roles->users))) {
            return response()->json([
                'status'  => false,
                'message' => 'این نقش قابل حذف نیست.'
            ]);
        } else {
            $this->delete($id);
            return response()->json([
                'status' => true
            ]);
        }
    }

    public function delete($id)
    {
        $this->authorize($this->page.'_delete');
        $role = Roles::find($id);
        \DB::transaction(function () use ($role) {
            $role->delete();
        });
    }

    /**
     * handle ajax requests
     * @param Request $request
     * @return void
     */
    public function ajax(Request $request)
    {
        $action = $request->input('action');
        return $this->$action($request);
    }

    public function remove_rows(Request $request)
    {
        $rows = $request->input('rows');
        foreach ($rows as $id) {
            $roles = Roles::find($id);
            if (empty(count($roles->users))) {
                $this->delete($id);
            }
        }
        return response()->json([
            'status' => true
        ]);
    }
}
