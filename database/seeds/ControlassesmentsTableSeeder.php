<?php

use Illuminate\Database\Seeder;

class ControlassesmentsTableSeeder extends Seeder
{
    public function run()
    {
        App\Controlassesment::unguard();
        DB::table('controlassesments')->delete();

        $controlassesments = factory('App\Controlassesment', 25)
            ->create()
            ->each(function ($controlassesment) {
                //Associate excisting users to a role;
                $users = App\User::all()->lists('id')->toArray();
                $rand_user = array_rand($users, 3);
                $controlassesment->auditor()->associate($users[$rand_user[0]]);
                $controlassesment->auditee()->associate($users[$rand_user[1]]);
                $controlassesment->approveer()->associate($users[$rand_user[2]]);

                //Associate excisting controlactivity;
                $controlactivity = App\Controlactivity::orderByRaw('RAND()')->first()->id;
                $controlassesment->controlactivity()->associate($controlactivity);

                //Associate new deficiencies;
                $deficiencyCount = rand(2, 5);
                $controlassesment->deficiencies()->saveMany(
                    factory('App\Deficiency', $deficiencyCount)->make()->each(function ($deficiency) {
                        $owner = App\Role::orderByRaw('RAND()')->first()->id;
                        $deficiency->owner()->associate($owner);
                    })
                );

                $controlassesment->save();
            });
    }
}
