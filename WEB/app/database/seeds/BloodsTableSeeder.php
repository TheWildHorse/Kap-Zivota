<?php

class BloodsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('bloods')->truncate();


		$bloods = array(
			array('type' => '0-'),
			array('type' => '0+'),
			array('type' => 'A-'),
			array('type' => 'A+'),
			array('type' => 'B-'),
			array('type' => 'B+'),
			array('type' => 'AB-'),
			array('type' => 'AB+')
		);

		DB::table('bloods')->insert($bloods);
	}

}
