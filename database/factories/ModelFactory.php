<?php
    use Carbon\Carbon;

/*
     * Users seeder
     */
    $factory->define(App\User::class, function ($faker) {
        return [
            'name'     => $faker->name,
            'email'    => $faker->safeEmail,
            'password' => Hash::make('Password'),
        ];
    });

    /*
     * Role seeder
     */
    $factory->define(App\Role::class, function ($faker) {
        $roleNames = ['Maintainer A',
                        'Maintainer B',
                        'Maintainer C',
                        'Owner A',
                        'Owner B',
                        'Owner C', ];

        return [
            'name'        => $faker->randomElement($roleNames),
            'description' => $faker->text,
            'active'      => $faker->boolean(75),
        ];
    });

    /*
     * Asset seeder
     */
    $factory->define(App\Asset::class, function ($faker) {
        return [
            'name'         => $faker->word,
            'description'  => $faker->text,
            'active'       => $faker->boolean(75),
            'continuity'   => $faker->numberBetween(0, 5),
            'integrity'    => $faker->numberBetween(0, 5),
            'availability' => $faker->numberBetween(0, 5),
            'type'         => $faker->numberBetween(0, 5),
        ];
    });

    /*
     * EnterpriseGoal seeder
     */
    $factory->define(App\EnterpriseGoal::class, function ($faker) {
        return [
            'name'        => $faker->word,
            'description' => $faker->text,
            'dimention'   => $faker->numberBetween(0, 3),
        ];
    });

    /*
     * Process seeder
     */
    $factory->define(App\Process::class, function ($faker) {
        return [
            'name'        => $faker->word,
            'description' => $faker->text,
            'ref'         => $faker->numberBetween(1000, 9999),
        ];
    });

    /*
     * Threat seeder
     */
    $factory->define(App\Threat::class, function ($faker) {
        return [
            'name'        => $faker->word,
            'description' => $faker->text,
            'chance'      => $faker->numberBetween(0, 5),
            'impact'      => $faker->numberBetween(0, 5),
        ];
    });

    /*
     * Controlframework seeder
     */
    $factory->define(App\Controlframework::class, function ($faker) {
        return [
            'name'        => $faker->word,
            'description' => $faker->text,
            'active'      => $faker->boolean(75),
        ];
    });

    /*
     * Controlobjective seeder
     */
    $factory->define(App\Controlobjective::class, function ($faker) {
        return [
            'name'        => $faker->word,
            'description' => $faker->text,
            'active'      => $faker->boolean(75),
            'intref'      => $faker->postcode,
            'extref'      => $faker->postcode,
        ];
    });

    /*
     * Controlframework seeder
     */
    $factory->define(App\Improvement::class, function ($faker) {
        return [
            'name'        => $faker->word,
            'description' => $faker->text,
            'status'      => $faker->numberBetween(0, 2),
            //'owner_id' => 'factory:App\Role',
        ];
    });

    /*
     * Controlactivity seeder
     */
    $factory->define(App\Controlactivity::class, function ($faker) {
        return [
            'name'                  => $faker->word,
            'description'           => $faker->text,
            'active'                => $faker->boolean(75),
            'key_control'           => $faker->boolean(50),
            'perform_frequency'     => $faker->numberBetween(0, 7),
            'test_frequency'        => $faker->numberBetween(0, 7),
            'justification'         => $faker->text,
            'intref'                => $faker->postcode,
            'extref'                => $faker->postcode,
            'control_type'          => $faker->numberBetween(0, 2),
            'control_execution'     => $faker->numberBetween(0, 1),
            'control_activitiescol' => 1,
            'implementation_status' => $faker->numberBetween(0, 1),
        ];
    });

    /*
     * Controlassesment seeder
     */
    $factory->define(App\Controlassesment::class, function ($faker) {
        //Pick relates start finish and approve dates
        $startDate = Carbon::createFromTimeStamp($faker->dateTimeBetween('-6 months', '+6 months')->getTimestamp());
        $finishDate = $startDate->copy()->addDays($faker->numberBetween(1, 30));
        if ($startDate > Carbon::now()) {
            $approveDate = null;
            $completeDate = null;
            $conclusion = 0;
        } else {
            $conclusion = $faker->numberBetween(1, 3);
            if ($faker->numberBetween(1, 3) < 3) {
                $completeDate = $finishDate->copy()->subDays($faker->numberBetween(0, 3));
            } else {
                $completeDate = $finishDate->copy()->addDays($faker->numberBetween(0, 3));
            }
            $approveDate = $completeDate->copy()->addDays($faker->numberBetween(1, 7));
        }

        return [
            'start'          => $startDate,
            'finish'         => $finishDate,
            'finding'        => $faker->text,
            'conclusion'     => $conclusion,
            'approved_date'  => $approveDate,
            'completed_date' => $completeDate,
        ];
    });

    /*
     * Testofcontrol seeder
     */
    $factory->define(App\Testofcontrol::class, function ($faker) {
        return [
            'name' => $faker->word,
            'test' => $faker->text,
        ];
    });

    /*
     * Deficiency seeder
     */
    $factory->define(App\Deficiency::class, function ($faker) {
        return [
            'name'        => $faker->word,
            'description' => $faker->text,
            'rootcause'   => $faker->text,
            //'owner_id' => $faker->randomElement($roles),
            //'controlassesment_id' => $faker->randomElement($controlassesments)
        ];
    });
