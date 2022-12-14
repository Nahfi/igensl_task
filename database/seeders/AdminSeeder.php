<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isNull;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::where('email','superadmin@example.com')->first();
        if(!($admin)){
           $admin =  Admin::create([
                'name' => 'SuperAdmin',
                'country' =>'BANGLADESH',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('123456789'),
                'status' => 'Active'
            ]);
            $admin->assignRole('SuperAdmin');
        }
    }
}