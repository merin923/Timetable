<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i=0; $i<10; $i++){
            DB::table('students')->insert([
                'full_name' => $faker->name,
                'roll_number' => 'ST' . $i
            ]);
        }
    }
}
