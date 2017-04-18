<?php

use Illuminate\Database\Seeder;

class ControlobjectivesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('controlobjectives')->delete();

        $controlobjectives = factory('App\Controlobjective', 10)
            ->create()
            ->each(function ($controlobjective) {
                //Set controlframeworks relationship
                $controlframeworks = App\Controlframework::all()->lists('id');
                $controlframeworksCount = count($controlframeworks);
                $relations = array_rand($controlframeworks->toArray(), rand(1, $controlframeworksCount));
                if (count($relations) == 1) {
                    $controlobjective->controlframeworks()->attach($controlframeworks[$relations]);
                } else {
                    foreach ($relations as $relation) {
                        $controlobjective->controlframeworks()->attach($controlframeworks[$relation]);
                    }
                }

                //Set Threat relatioship
                $threats = App\Threat::all()->lists('id');
                $threatCount = count($threats);
                $relations = array_rand($threats->toArray(), rand(1, $threatCount));
                if (count($relations) == 1) {
                    $controlobjective->threats()->attach([$threats[$relations] => ['eec' => rand(0, 100)]]);
                } else {
                    foreach ($relations as $relation) {
                        $controlobjective->threats()->attach([$threats[$relation] => ['eec' => rand(0, 100)]]);
                    }
                }
            });
    }
}
