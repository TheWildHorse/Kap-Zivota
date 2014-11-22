<?php

class PremissionsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('premissions')->truncate();

		$premissions = array(
			array('name' => 'user'),
			array('name' => 'admin'),
			array('name' => 'superadmin'),
		);

		DB::table('premissions')->insert($premissions);
	}

}
