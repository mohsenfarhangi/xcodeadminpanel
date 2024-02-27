<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Core\Util;
use App\Models\Cities;
use App\Models\Drivers;
use App\Models\Provinces;
use App\Models\Users;
use App\Models\UsersAddresses;
use App\Traits\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;

class UserProfileController extends Controller
{
    use Media;

    private $page = "user";

    public function index(Request $request)
    {
        $this->authorize($this->page . "_profile");
        $id = $request->id;
        if (empty($id)) {
            return redirect()->route('user.index');
        }

        $user = Users::find($id);
        if (empty($user)) {
            return redirect()->route('user.index');
        }
        $addresses = $user->addresses;
        $provinces = Provinces::all();
        $cities    = Cities::where('province_id', $user->province_id)->get();
        $tabs      = [
            "overview" => [
                'title'   => __('cpanel.Account Overview'),
                'default' => true,
                'can'     => 'user_profile_overview'
            ],
            "address"  => [
                'title'   => __('cpanel.address'),
                'default' => false,
                'can'     => 'user_profile_address'
            ]
        ];
        return view('pages.user-profile.index', get_defined_vars());
    }

    /**
     * تغییر اطلاعات کاربر
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeDetails(Request $request)
    {

        $users = Users::find($request->input('id'));

        if (empty($users)) {
            return $this->jsonResponse([
                'status' => false,
                'errors' => __('auth.user not found')
            ]);
        };

        $validation_args = [
            'full_name'   => 'required',
            'email'       => 'nullable',
            'birth_date'  => 'nullable',
            'province_id' => 'required',
            'city_id'     => 'required',
            'status'      => 'required',
            'id'          => 'required'
        ];


        if ($request->input('mobile') != $users->mobile) {
            $validation_args['mobile'] = 'required|unique:users,mobile|max:11';
        } else {
            $validation_args['mobile'] = 'required|max:11';
        }

        $validator = Validator::make($request->all(), $validation_args);

        if ($validator->fails()) {
            return $this->jsonResponse([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        };

        $birth_date = CalendarUtils::convertNumbers($request->input('birth_date'), true);

        $users->update([
            'full_name'   => $request->input('full_name'),
            'mobile'      => $request->input('mobile'),
            'birth_date'  => Jalalian::fromFormat('Y/m/d', $birth_date)->toCarbon(),
            'province_id' => $request->input('province_id'),
            'city_id'     => $request->input('city_id'),
            'status'      => $request->input('status'),
            'email'       => $request->input('email'),
        ]);

        return $this->jsonResponse([
            'status' => true,
            'data'   => $users
        ]);
    }

    /**
     * upload new avatar
     * @return void
     */
    public function uploadNewAvatar(Request $request)
    {
        $this->authorize('driver_profile_change_avatar');
        if ($request->hasFile("avatar")) {
            $fileData = $this->upload(request()->file('avatar'), 'packages/');

            if (empty($fileData)) {
                return $this->jsonResponse([
                    'status' => false,
                    'errors' => __('cpanel.The file could not be uploaded')
                ]);
            }

            $users = Users::find($request->input('id'));
            if (empty($users)) {
                return $this->jsonResponse([
                    'status' => false,
                    'errors' => __('auth.user not found')
                ]);
            }
            $this->removeFile("packages/" . $users->profile->path);
            $users->profile()->updateOrCreate([
                'user_id' => $request->input('id')
            ],
                [
                    'status' => 1,
                    'path'   => $fileData['file_path'],
                    'size'   => $fileData['file_size'],
                    'width'  => $fileData['file_width'],
                    'height' => $fileData['file_height']
                ]);

            return $this->jsonResponse([
                'status' => true,
                'url'    => getUserImage($users->getAvatarPath())
            ]);
        } else {
            return $this->jsonResponse([
                'status' => false,
                'errors' => __('cpanel.image is required')
            ]);
        }
    }

    /**
     * remove driver avatar file
     * @return void
     */
    public function removeAvatar(Request $request)
    {
        $this->authorize('driver_profile_remove_avatar');

        $users = Users::find($request->input('id'));

        if (empty($users)) {
            return $this->jsonResponse([
                'status' => false,
                'errors' => __('auth.user not found')
            ]);
        }

        $driverAvatar = $users->profile()->first();

        $this->removeFile("packages/" . $driverAvatar->path);
        return $this->jsonResponse([
            'status' => true
        ]);
    }

    /**
     * update user address
     * @param Request $request
     * @return void
     */
    public function saveUserAddress(Request $request)
    {
        $this->authorize("user_profile_address_edit");
        $user = Users::find($request->input('id'));
        if (empty($user)) {
            return response()->json([
                'status' => false,
                'errors' => __("auth.user not found")
            ]);
        }

        $validator = Validator::make($request->all(), [
            'address_title'       => 'required',
            'address_province_id' => 'required',
            'address_city_id'     => 'required',
            'address_format'      => 'required',
            'address.lat'         => 'required',
            'address.lng'         => 'required',
        ]);

        if ($validator->fails()) {
            return $this->jsonResponse([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        };

        if ($request->input('address_id') != -1) {
            if (empty($request->input('address_id'))) {
                if ($user->addresses()->count() >= 3) {
                    return response()->json([
                        'status' => false,
                        'errors' => __("cpanel.You can create only 3 addresses")
                    ]);
                }
            }

            $user->addresses()->updateOrCreate([
                'id' => $request->input('address_id') ?? 0
            ], [
                'title'       => $request->input('address_title'),
                'province_id' => $request->input('address_province_id'),
                'city_id'     => $request->input('address_city_id'),
                'address'     => $request->input('address_format'),
                'geo'         => \DB::raw("ST_GeomFromText('POINT(" . $request->input('address.lng') . " " . $request->input('address.lat') . ")',1)"),
                'status'      => 1
            ]);
        } else {
            $user->update([
                'province_id' => $request->input('address_province_id'),
                'city_id'     => $request->input('address_city_id'),
                'address'     => $request->input('address_format'),
                'geo'         => \DB::raw("ST_GeomFromText('POINT(" . $request->input('address.lng') . " " . $request->input('address.lat') . ")',1)"),
            ]);
        }

        return $this->jsonResponse([
            'status' => true
        ]);

    }

    /***
     * get user address by address id
     * @param Request $request
     * @return void
     */
    public function getUserAddressByid(Request $request)
    {
        $response = [];
        if ($request->input('address_id') != -1) {
            $address = UsersAddresses::find($request->input('address_id'));
            if (empty($address)) {
                return response()->json([
                    'status' => false,
                    'errors' => __("cpanel.Not found")
                ]);
            }
            $response = [
                'id'          => $address->id,
                'status'      => true,
                'title'       => $address->title,
                'province_id' => $address->province_id,
                'city_id'     => $address->city_id,
                'geo'         => $address->geo_points,
                'address'     => $address->address,
            ];
        } else {
            $user = Users::find($request->input('user_id'));
            if (empty($user)) {
                return response()->json([
                    'status' => false,
                    'errors' => __("auth.user not found")
                ]);
            }
            $response = [
                'id'          => -1,
                'status'      => true,
                'title'       => __('cpanel.default'),
                'province_id' => $user->province_id,
                'city_id'     => $user->city_id,
                'geo'         => $user->geo_points,
                'address'     => $user->address,
            ];
        }


        return response()->json($response);
    }

    /**
     * حذف آدرس های ثبت شده کاربر
     * @param Request $request
     * @return void
     */
    public function removeUserAddress(Request $request)
    {
        if ($request->input('address_id') == -1) {
            return response()->json([
                'status' => false,
                'errors' => __("cpanel.This item cannot be deleted")
            ]);
        }

        $user = Users::find($request->input('user_id'));
        if (empty($user)) {
            return response()->json([
                'status' => false,
                'errors' => __("auth.user not found")
            ]);
        }

        $address = $user->addresses()->where('id', $request->input('address_id'))->first();
        if (empty($address)) {
            return response()->json([
                'status' => false,
                'errors' => __("cpanel.Not found")
            ]);
        }
        $address->delete();
        return response()->json([
            'status' => true
        ]);

    }
}
