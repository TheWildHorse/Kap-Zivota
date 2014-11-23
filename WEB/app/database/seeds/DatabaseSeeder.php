<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('InstitutionsTableSeeder');
		$this->call('PremissionsTableSeeder');
		$this->call('BloodsTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('DonationsTableSeeder');
		$this->call('BloodsuppliesTableSeeder');
        $this->call('AchivementTableSeeder');
	}

}
