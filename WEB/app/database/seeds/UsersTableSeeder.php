<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('users')->truncate();

		$users = array(
			array('institution_id' => rand(1, 7),
				'blood_id' => rand(1, 8),
				'premission_id' => 0,
				'gender' => 'M',
				'username' => 'user1',
				'password' => Hash::make("pass"),
				'name' => 'Ivo', 'surname' => 'Ivić',
				'email' => 'ivo.ivic@example.com',
				'birthdate' => '1999-05-11'),
			array('institution_id' => rand(1, 7),
				'blood_id' => rand(1, 8),
				'premission_id' => 2,
				'gender' => 'M',
				'username' => 'user2',
				'password' => Hash::make("pass"),
				'name' => 'Pero', 'surname' => 'Kos',
				'email' => 'perko.kos@example.com',
				'birthdate' => '1992-08-01'),
			array('institution_id' => rand(1, 7),
				'blood_id' => rand(1, 8),
				'premission_id' => 2,
				'gender' => 'F',
				'username' => 'user3',
				'password' => Hash::make("pass"),
				'name' => 'Sanja', 'surname' => 'Mudri',
				'email' => 'sanja.mudri@example.com',
				'birthdate' => '1992-02-25'),
			array('institution_id' => rand(1, 7),
				'blood_id' => rand(1, 8),
				'premission_id' => 1,
				'gender' => 'F',
				'username' => 'user4',
				'password' => Hash::make("pass"),
				'name' => 'Marina', 'surname' => 'Kozlić',
				'email' => 'sanja.mudri@example.com',
				'birthdate' => '1956-12-13'),
			array('institution_id' => rand(1, 7),
				'blood_id' => rand(1, 8),
				'premission_id' => 0,
				'gender' => 'M',
				'username' => 'user5',
				'password' => Hash::make("pass"),
				'name' => 'Hrvoje', 'surname' => 'Horvat',
				'email' => 'hrvoje.horvat@example.com',
				'birthdate' => '1976-03-27'),
			array('institution_id' => rand(1, 7),
				'blood_id' => rand(1, 8),
				'premission_id' => 0,
				'gender' => 'M',
				'username' => 'user6',
				'password' => Hash::make("pass"),
				'name' => 'Matija', 'surname' => 'Horvat',
				'email' => 'matija.horvat@example.com',
				'birthdate' => '1982-07-17'),
			array('institution_id' => rand(1, 7),
				'blood_id' => rand(1, 8),
				'premission_id' => 0,
				'gender' => 'F',
				'username' => 'user7',
				'password' => Hash::make("pass"),
				'name' => 'Ivana', 'surname' => 'Marić',
				'email' => 'ivana.marić@example.com',
				'birthdate' => '1992-07-17'),

		);

		DB::table('users')->insert($users);
	}

}
