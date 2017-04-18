<?php

use Illuminate\Database\Seeder;

class ControlframeworksTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('controlframeworks')->delete();

        $sontrolframeworks = factory('App\Controlframework', 10)
            ->create()
            ->each(function ($controlframework) {
                //Associate excisting owner;
                $owner = App\Role::orderByRaw('RAND()')->first()->id;
                $controlframework->owner()->associate($owner);
                $controlframework->save();
            });
    }
}
