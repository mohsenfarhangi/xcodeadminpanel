<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\PermissionsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cpanel\Permission\StoreRequest;
use App\Models\Permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class PermissionsController extends Controller
{
    private $page = "permission";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PermissionsDataTable $dataTable)
    {
        $this->authorize($this->page.'_list');
        return $dataTable->render('pages.permission.index');
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
        if ($request->has('item_id')) {
            $this->authorize($this->page.'_update');
        } else {
            $this->authorize($this->page.'_create');
        }
        Permissions::updateOrCreate([
            'id' => $request->input('permission_id')
        ], [
            'description' => $request->input('description'),
        ]);
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
        $permissoin = Permissions::find($id);

        $permissoin->delete();
        return response()->json([
            'status' => true
        ]);
    }

    public function delete($id)
    {
        $this->authorize($this->page.'_delete');
        $role = Permissions::find($id);
        \DB::transaction(function () use ($role) {
            $role->delete();
        });
    }

    public function remove_rows(Request $request)
    {
        $rows = $request->input('rows');
        foreach ($rows as $id) {
            $this->delete($id);
        }
        return response()->json([
            'status' => true
        ]);
    }

    public function updateList(Request $request)
    {
        $this->authorize($this->page.'_update');
        Artisan::call("db:seed --class=PermissionSeeder");
    }
}
