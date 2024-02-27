<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Users;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::count()) {
            DB::transaction(function () {
                $user = \App\Models\User::create([
                    'username' => 'demo',
                    'password' => Hash::make('demo'),
                    'email'    => 'demo@demo.com',
                    'status'   => 'active',
                    'superadmin' => 1
                ]);
                $user->info()->create([
                    'first_name' => 'مدیر',
                    'last_name'  => 'مدیری',
                    'gender'     => 'male',
                    'mobile'     => '09112223344',
                ]);
            });

        }
    }
}
