<?php

use Illuminate\Database\Seeder;

//Load models
use App\Process;
use App\Role;
use App\Asset;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class ProcessesTableSeeder extends Seeder {

    public function run()
    {
        Eloquent::unguard();
        DB::table('processes')->delete();

        $processes = factory('App\Process', 10)
            ->create()
            ->each(function($process) {
                //Associate excisting owner; 
                $owner = App\Role::orderByRaw("RAND()")->first()->id;
                $maintainer = App\Role::orderByRaw("RAND()")->first()->id;
                $assets = App\Asset::all()->lists('id');
                $children = factory('App\Process', rand(1,5))->make();
                $process->owner()->associate($owner);
                $process->maintainer()->associate($maintainer);

                //Fill pivot for assets
                //dd($assets->toArray());
                $relations = array_rand($assets->toArray(), rand(1,count($assets)));
                if(count($relations)==1){
                    $process->assets()->attach($assets[$relations]);
                }else{
                    foreach ($relations as $relation){
                        $process->assets()->attach($assets[$relation]);
                    }
                }                

                //Set child processes
                foreach ($children as $child) {
                    if(is_object($child)){
                        $process->children()->create($child['attributes']);
                    }
                }

                $process->save();
            });
    }
}