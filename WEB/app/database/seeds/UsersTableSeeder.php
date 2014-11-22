<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('users')->truncate();

		$users = array(
			array('institution_id' => random(1,7), 'blood_id'=>random(1,8),'gender'=>'M', 7''),
		);

		// Uncomment the below to run the seeder
		// DB::table('users')->insert($users);
	}

}
