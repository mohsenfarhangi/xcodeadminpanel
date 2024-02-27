<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getCurrentUser()
    {
        return auth('web')->user() ?: auth('web_users')->user();
    }

    protected function jsonResponse($data, $code = 200)
    {
        return response()->json($data, $code,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
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

    /**
     * remove dataTable rows
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
    /**
     * get users list for select2
     * use [data-select="users"] in select input
     * * Example:
     * <select data-select="users"></select>
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsers(Request $request)
    {
        $users = Users::select('id', 'full_name')
                      ->where('full_name', 'like', "%$request->search%")
                      ->orWhere('mobile', 'like', "%$request->search%")
                      ->orWhere('user_code', 'like', "%$request->search%")
                      ->orWhere('email', 'like', "%$request->search%")
                      ->where('status', 1);
        if (!empty($request->input('user_id'))) {
            $currentUser = Users::find($request->input('user_id'));
            $users       = $users->whereNotIn('id', [$currentUser->id]);
        }
        $results = [];
        foreach ($users->get() as $user) {
            $results[] = [
                'id'   => $user->id,
                'text' => $user->full_name,
            ];
        }
        if (!empty($request->input('user_id'))) {
            $results[] = [
                'id'       => $currentUser->id,
                'text'     => $currentUser->full_name,
                "selected" => true
            ];
        }
        return response()->json([
            'results' => $results
        ]);
    }
}
