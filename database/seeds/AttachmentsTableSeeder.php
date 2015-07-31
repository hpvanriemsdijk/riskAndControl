<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class AttachmentsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('attachments')->delete();
        //TestDummy::times(10)->create('App\Attachment');
        //Wait till we actualy use it.
    }

}