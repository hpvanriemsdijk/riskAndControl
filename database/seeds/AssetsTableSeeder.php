<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;    

//Load models
//use App\Asset;

/* 
 * AssetsTableSeeder
 *
 * We don't use testdummy here. This model uses baum, testdummy is unfit to use Baum.
 *
 */

class AssetsTableSeeder extends Seeder {
    public function run()
    {
    	Eloquent::unguard();
        DB::table('assets')->delete();

        $assets = factory('App\Asset', 10)
        	->create()
        	->each(function($asset) {
        		//Associate excisting owner; 
        		$owner = App\Role::orderByRaw("RAND()")->first()->id;
        		$maintainer = App\Role::orderByRaw("RAND()")->first()->id;
        		$children = factory('App\Asset', rand(1,5))->make();
				$asset->owner()->associate($owner);
				$asset->maintainer()->associate($maintainer);

				//dd($children);
				foreach ($children as $child) {
					if(is_object($child)){
						$asset->children()->create($child['attributes']);
					}
				}

				$asset->save();
            });
    }
}