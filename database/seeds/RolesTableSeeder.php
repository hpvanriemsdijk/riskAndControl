<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->delete();

        $roles = factory('App\Role', 10)
            ->create()
            ->each(function ($role) {
                //Associate excisting user;
                $user = App\User::orderByRaw('RAND()')->first()->id;
                $role->user()->associate($user);
                $role->save();
            });
    }
}
