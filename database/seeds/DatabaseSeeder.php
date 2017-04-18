<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Company
        $this->call('UsersTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('AssetsTableSeeder');
        $this->call('EnterpriseGoalsTableSeeder');
        $this->call('ProcessesTableSeeder');

        //Risk managemnt
        $this->call('ThreatsTableSeeder');

        //Governance
        $this->call('ControlframeworksTableSeeder');
        $this->call('ControlobjectivesTableSeeder');
        $this->call('ControlactivitiesTableSeeder');
        //$this->call('TestofcontrolsTableSeeder'); 	//Called from ControlactivitiesTableSeeder
        $this->call('ControlassesmentsTableSeeder');
        //$this->call('DeficienciesTableSeeder');		//Called from ControlactivitiesTableSeeder
        $this->call('ImprovementsTableSeeder');

        //Application
        //$this->call('AttachmentsTableSeeder');
    }
}
