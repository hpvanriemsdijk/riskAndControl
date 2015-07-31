<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;  

class ControlactivitiesTableSeeder extends Seeder {

    public function run()
    {
        App\Controlactivity::unguard();
        DB::table('controlactivities')->delete();

        $controlactivities = factory('App\Controlactivity', 25)
            ->create()
            ->each(function($controlactivity) {
                //Associate excisting owner; 
                $owner = App\Role::orderByRaw("RAND()")->first()->id;
                $controlactivity->owner()->associate($owner);
                $controlactivity->save();

                //Fill pivot controlactivity_controlobjective
                $controlobjectives = App\Controlobjective::all()->lists('id');
                $controlobjectivesCount = count($controlobjectives);
                $relations = array_rand($controlobjectives->toArray(), rand(1,$controlobjectivesCount));
                if(count($relations)==1){
                    $controlactivity->controlobjectives()->attach($controlobjectives[$relations]);
                }else{
                    foreach ($relations as $relation){
                        $controlactivity->controlobjectives()->attach($controlobjectives[$relation]);
                    }
                }

                //Create new test and associate
                $controlactivity->testsofcontrol()->save(factory('App\Testofcontrol')->make()); 
            });
    }

}