<?php

class BloodsuppliesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		 DB::table('BloodSupplies')->truncate();

		$bloodsupplies = array(

                array('institution_id' => '1','blood_id'=>'1','quantity'=>'1200'),
                array('institution_id' => '1','blood_id'=>'3','quantity'=>'1200'),
                array('institution_id' => '1','blood_id'=>'5','quantity'=>'1200'),


		);

		// Uncomment the below to run the seeder
		 DB::table('BloodSupplies')->insert($bloodsupplies);
	}

}
