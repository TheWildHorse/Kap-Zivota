<?php

class InstitutionsTableSeeder extends Seeder {

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::table('institutions')->truncate();

        $institutions = array(
            array('name'=>'KBC Rebro','description'=>'Klinički bolnički centar Rebro, Zagreb','geo_lat'=>'45.823818','geo_lon'=>'16.0061151'),
            array('name'=>'Firule','description'=>'Bolnica Firule, Split','geo_lat'=>'43.501263','geo_lon'=>'16.4536505'),
            array('name'=>'Bolnica Osijek','description'=>'Bolnica Osijek','geo_lat'=>'45.5576607','geo_lon'=>'18.7149377'),
            array('name'=>'Bolnica Dubrovnik','description'=>'Opća bolnica Dubrovnik','geo_lat'=>'42.6487073','geo_lon'=>'18.0759794'),
            array('name'=>'Bolnica Pula','description'=>'Opća bolnica Pula','geo_lat'=>'44.8682959','geo_lon'=>'13.8532526'),
            array('name'=>'Bolnica Rijeka','description'=>'Opća bolnica Rijeka','geo_lat'=>'45.330997','geo_lon'=>'14.4286087'),
            array('name'=>'Bolnica Zadar','description'=>'Opća bolnica Zadar','geo_lat'=>'44.1070439','geo_lon'=>'15.2346647'),
            array('name'=>'Bolnica Vukovar','description'=>'Opća bolnica Vukovar','geo_lat'=>'45.3584225','geo_lon'=>'18.9943431'),
        );

        // Uncomment the below to run the seeder
         DB::table('institutions')->insert($institutions);
    }

}
