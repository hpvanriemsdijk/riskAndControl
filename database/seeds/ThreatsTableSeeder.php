<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;   

class ThreatsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('threats')->delete();
        
        $threats = factory('App\Threat', 10)
            ->create()
            ->each(function($threat) {
                $assets = App\Asset::all()->lists('id');
                $enterpriseGoals = App\EnterpriseGoal::all()->lists('id');
                $processes = App\Process::all()->lists('id');
                $threatTargets = ['assets', 'enterpriseGoals', 'processes'];

                foreach ($threatTargets as $threatTarget) {
                    if(rand(0,1)){
                        $relations = array_rand(${$threatTarget}->toArray(), rand(1,count(${$threatTarget})));
                        if(count($relations)==1){
                            $Threat->{$threatTarget}()->attach(${$threatTarget}[$relations]);
                        }else{
                            foreach ($relations as $relation){
                                $threat->{$threatTarget}()->attach(${$threatTarget}[$relation]);
                            }
                        }
                    }
                }  

                $children = factory('App\Threat', rand(1,5))->make();
                foreach ($children as $child) {
                    if(is_object($child)){
                        $threat->children()->create($child['attributes']);
                    }
                }


            });
    }

}