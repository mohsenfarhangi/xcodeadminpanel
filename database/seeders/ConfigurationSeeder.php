<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = [
//            ['status' => 'active', 'name' => 'min_balance_to_accept_order', 'value' => '100000'],
        ];
        if (Setting::count() < count($options)) {
            Setting::upsert($options, ['name'], ['status', 'value']);
        }
    }
}
