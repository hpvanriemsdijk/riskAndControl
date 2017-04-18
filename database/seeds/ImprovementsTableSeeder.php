<?php

use Illuminate\Database\Seeder;

class ImprovementsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('improvements')->delete();
        $improvements = factory('App\Improvement', 25)
            ->create()
            ->each(function ($improvement) {
                //Associate excisting owner;
                $owner = App\Role::orderByRaw('RAND()')->first()->id;
                $improvement->owner()->associate($owner);

                //Fill pivot controlactivity_controlobjective
                $deficiencies = App\Deficiency::all()->lists('id');
                $deficienciesCount = count($deficiencies);
                $relations = array_rand($deficiencies->toArray(), rand(1, min(3, $deficienciesCount)));
                if (count($relations) == 1) {
                    $improvement->deficiencies()->attach($deficiencies[$relations]);
                } else {
                    foreach ($relations as $relation) {
                        $improvement->deficiencies()->attach($deficiencies[$relation]);
                    }
                }

                $improvement->save();
            });
    }
}
