<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use App\Models\Admin\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::create(
            [
                'email' => 'admin@admin.com',
                'password' => '12345678'
            ]
        );
        // \App\Models\User::factory(10)->create();
    }
}
