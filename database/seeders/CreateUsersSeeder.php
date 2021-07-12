<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;


class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'ouissal',
                'username' => 'admin',
                'email' => 'ouissal@gmail.com',
                'is_admin' => '1',
                'password' => bcrypt('ouissal'),
            ],
            [
                'name' => 'User',
                'email' => 'user@admin.com',
                'username' => 'user',
                'is_admin' => '0',
                'password' => bcrypt('123456'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
