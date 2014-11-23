<?php

class AchivementTableSeeder extends Seeder {

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::table('achivements')->truncate();


        $bloods = array(
            array('name' => 'newbie','number'=>'1'),
            array('name' => 'experienced member','number'=>'5'),
            array('name' => 'good person','number'=>'10'),
            array('name' => 'life saviour','number'=>'15'),
            array('name' => 'a legend','number'=>'20'),
        );

        DB::table('achivements')->insert($bloods);
    }

}