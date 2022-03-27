<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'     => 'adminDelivery',
            'email'    => 'adminDelivery@gmail.com',
            'role'    => 'admin',
            'password' => bcrypt('admin12345'),
        ]);   
    }
}
