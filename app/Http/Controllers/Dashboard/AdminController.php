<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\AdminsDataTable;
use App\Http\Controllers\Api\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cpanel\Admins\StoreRequest;
use App\Models\Admins;
use Illuminate\Http\Request;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;

class AdminController extends Controller
{
    private $page = "admin";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminsDataTable $dataTable)
    {
        $this->authorize($this->page.'_list');

        return $dataTable->render('pages.admin.index');
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
        if ($request->has('user_id')) {
            $this->authorize($this->page.'_update');
        } else {
            $this->authorize($this->page.'_create');
        }

        $birth_date = CalendarUtils::convertNumbers($request->input('birth_date'), true);
        \DB::transaction(function () use ($request, $birth_date) {
            $args = [
                'first_name' => $request->input('first_name'),
                'last_name'  => $request->input('last_name'),
                'mobile'     => $request->input('mobile'),
                'email'      => $request->input('email'),
                'birth_date' => Jalalian::fromFormat('Y/m/d', $birth_date)->toCarbon(),
                'status'     => $request->input('status'),
                'superadmin' => 0,
            ];
            if ($request->has('password') && $request->filled('password')) {
                $args['password'] = \Hash::make($request->input('password'));
            }
            $admin = Admins::updateOrCreate([
                'id' => $request->input('user_id')
            ], $args);
            $admin->roles()->sync($request->input('role_id'));
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
        $current_user = auth('web')->user()->id;
        if ($current_user == $id) {
            return response()->json([
                'status'  => false,
                'message' => 'شما نمیتوانید حساب کاربری خود را حذف کنید.'
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
        $user = Admins::find($id);
        \DB::transaction(function () use ($user) {
            $user->roles()->detach();
            $user->delete();
        });
    }

    public function remove_rows(Request $request)
    {
        $rows         = $request->input('rows');
        $current_user = auth('web')->user()->id;
        foreach ($rows as $row) {
            if ($current_user != $row) {
                $this->delete($row);
            }

        }
        return response()->json([
            'status' => true
        ]);
    }
}
