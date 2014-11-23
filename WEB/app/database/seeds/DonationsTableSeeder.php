<?php

class DonationsTableSeeder extends Seeder {

	public function run()
	{

		DB::table('donations')->truncate();

		$donations = array(
			array(
				'user_id' => rand(1,7),
				'institution_id' => rand(1,7),
				'time' => time(),
				'measure' => 0.45,
			),
			array(
				'user_id' => rand(1,7),
				'institution_id' => rand(1,7),
				'time' => time(),
				'measure' => 0.45,
			),
			array(
				'user_id' => rand(1,7),
				'institution_id' => rand(1,7),
				'time' => time(),
				'measure' => 0.45,
			),
			array(
				'user_id' => rand(1,7),
				'institution_id' => rand(1,7),
				'time' => time(),
				'measure' => 0.45,
			),
			array(
				'user_id' => rand(1,7),
				'institution_id' => rand(1,7),
				'time' => time(),
				'measure' => 0.45,
			),
			array(
				'user_id' => rand(1,7),
				'institution_id' => rand(1,7),
				'time' => time(),
				'measure' => 0.45,
			),
			array(
				'user_id' => rand(1,7),
				'institution_id' => rand(1,7),
				'time' => time(),
				'measure' => 0.45,
			),
			array(
				'user_id' => rand(1,7),
				'institution_id' => rand(1,7),
				'time' => time(),
				'measure' => 0.45,
			),
			array(
				'user_id' => rand(1,7),
				'institution_id' => rand(1,7),
				'time' => time(),
				'measure' => 0.45,
			),
			array(
				'user_id' => rand(1,7),
				'institution_id' => rand(1,7),
				'time' => time(),
				'measure' => 0.45,
			),
			array(
				'user_id' => rand(1,7),
				'institution_id' => rand(1,7),
				'time' => time(),
				'measure' => 0.45,
			),
			array(
				'user_id' => rand(1,7),
				'institution_id' => rand(1,7),
				'time' => time(),
				'measure' => 0.45,
			),
			array(
				'user_id' => rand(1,7),
				'institution_id' => rand(1,7),
				'time' => time(),
				'measure' => 0.45,
			),
			array(
				'user_id' => rand(1,7),
				'institution_id' => rand(1,7),
				'time' => time(),
				'measure' => 0.45,
			),
			array(
				'user_id' => rand(1,7),
				'institution_id' => rand(1,7),
				'time' => time(),
				'measure' => 0.45,
			),
			array(
				'user_id' => rand(1,7),
				'institution_id' => rand(1,7),
				'time' => time(),
				'measure' => 0.45,
			),
			array(
				'user_id' => rand(1,7),
				'institution_id' => rand(1,7),
				'time' => time(),
				'measure' => 0.45,
			),
			array(
				'user_id' => rand(1,7),
				'institution_id' => rand(1,7),
				'time' => time(),
				'measure' => 0.45,
			),
			array(
				'user_id' => rand(1,7),
				'institution_id' => rand(1,7),
				'time' => time(),
				'measure' => 0.45,
			),
			array(
				'user_id' => rand(1,7),
				'institution_id' => rand(1,7),
				'time' => time(),
				'measure' => 0.45,
			),


		);

		DB::table('donations')->insert($donations);
	}

}
