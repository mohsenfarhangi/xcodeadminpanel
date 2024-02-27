<?php

namespace Database\Seeders;

use App\Models\Permissions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $permission_config = config('theme.permissions', []);
            $sections          = $permission_config['sections'];
            $permission_list   = $permission_config['permissions'];

            $this->removeExtraPermission($permission_list);

            $this->insertPermission($sections,$permission_list);

        });
    }

    public function insertPermission($sections,$permission_list)
    {
        foreach ($sections as $section => $section_title) {
            $parent = Permissions::updateOrCreate([
                'permission' => $section,
            ], [
                'title'  => $section_title,
                'parent' => 0
            ]);
            if (isset($permission_list[$section])) {
                foreach ($permission_list[$section] as $permission => $permission_title) {
                    $permission_name = $section . "_" . $permission;
                    $parent->childs()->updateOrCreate([
                        'permission' => $permission_name,
                    ], [
                        'title' => $permission_title
                    ]);
                }
            }
        }
    }

    public function removeExtraPermission($permission_list)
    {
        $permissions = Permissions::where('parent',0)->get();
        foreach ($permissions as $permission) {
            if (isset($permission_list[$permission->permission]) && !empty($permission->childs)) {
                foreach ($permission->childs as $child) {
                    $key = str_replace($permission->permission . "_", "", $child->permission);
                    if (!isset($permission_list[$permission->permission][$key])) {
                        $this->removePermission($child);
                    }
                }
            } else {
                $this->removePermission($permission);
            }
        }
    }

    public function removePermission(Permissions $permission)
    {
        $permission->roles()->detach();
        $permission->delete();
    }
}
