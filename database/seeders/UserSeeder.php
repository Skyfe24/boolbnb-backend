<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = config('users');

        foreach ($users as $user) {
            $new_user = new User();

            $new_user->name = $user['name'];
            $new_user->lastName = $user['lastName'];
            $new_user->birth_date = $user['birth_date'];
            $new_user->email = $user['email'];
            $new_user->password = bcrypt($user['password']);

            $new_user->save();
        }
    }
}
