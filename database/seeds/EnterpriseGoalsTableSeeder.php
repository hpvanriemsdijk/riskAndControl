<?php

use Illuminate\Database\Seeder;

//load models
use App\EnterpriseGoal;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class EnterpriseGoalsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('enterprise_goals')->delete();

        $enterpriseGoals = factory('App\EnterpriseGoal', 10)
        	->create()
        	->each(function($enterpriseGoal) {
        		//Associate excisting owner;  
        		$children = factory('App\EnterpriseGoal', rand(1,5))->make();

				foreach ($children as $child) {
					if(is_object($child)){
						$enterpriseGoal->children()->create($child['attributes']);
					}
				}

				$enterpriseGoal->save();
            });
    }
}