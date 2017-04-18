<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();

        $user = factory(App\User::class)->create([
            'name'     => 'Admin',
            'email'    => 'admin@test.nl',
            'password' => Hash::make('Password'),
        ]);

        $users = factory('App\User', 10)
            ->create();
    }
}
