<?php

namespace Database\Seeders;

use App\Models\UserRolePermission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RolePermissionSeeder::class,
            GeneralSettingsSeeder::class,
            AdminSeeder::class,
            CountrySeeder::class,
            UserRolePermissionSeeder::class,
            MailSettingSeeder::class
        ]);
    }
}
