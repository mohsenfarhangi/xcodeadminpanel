<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Core\Util;
use App\Http\Requests\Cpanel\User\StoreRequest;
use App\Imports\UsersImport;
use App\Models\Admins;
use App\Models\Users;
use App\Traits\Media;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Propaganistas\LaravelPhone\PhoneNumber;

class UserController extends Controller
{
    use Media;

    private $page = "user";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $dataTable)
    {
        $this->authorize($this->page . '_list');
        return $dataTable->render('pages.user.index');
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
            $this->authorize($this->page . '_update');
        } else {
            $this->authorize($this->page . '_create');
        }
        $birth_date = CalendarUtils::convertNumbers($request->input('birth_date'), true);

        \DB::transaction(function () use ($request, $birth_date) {
            $args  = [
                'full_name'  => $request->input('full_name'),
                'mobile'     => $request->input('mobile'),
                'email'      => $request->input('email'),
                'birth_date' => Jalalian::fromFormat('Y/m/d', $birth_date)->toCarbon(),
                'status'     => $request->input('status'),
                'user_code'  => Util::createUniqueCode('user')
            ];
            $admin = Users::updateOrCreate([
                'id' => $request->input('user_id')
            ], $args);
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
        $this->delete($id);
        return response()->json([
            'status' => true
        ]);
    }

    public function delete($id)
    {
        $this->authorize($this->page . '_delete');
        $user = Users::find($id);
        \DB::transaction(function () use ($user) {
            $user->delete();
        });
    }

    public function remove_rows(Request $request)
    {
        $rows = $request->input('rows');

        foreach ($rows as $row) {
            $this->delete($row);
        }
        return response()->json([
            'status' => true
        ]);
    }


    public function importUsers(Request $request)
    {
        try {
            $this->authorize($this->page . "_import");
            $source      = $request->file('file')->getRealPath();
            $destination = 'new_format_xlsx_file.xlsx';
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($source);
            $writer      = new Xlsx($spreadsheet);
            $writer->save($destination);
            $file_path = public_path($destination);

            Excel::import(new UsersImport(), $file_path);
            \File::delete($file_path);
            return response()->json([
                'status' => true
            ]);
        } catch (\Throwable $throwable) {
            return $throwable;
        }
    }
}
