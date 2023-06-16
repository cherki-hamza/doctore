<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use TCG\Voyager\Models\Role;
use Carbon\Carbon;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $cities = DB::table('cities')->pluck('id');
        $bloodGroups = DB::table('blood_groups')->pluck('id');
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) {
            $minDate = Carbon::today()->subDays(60);

            DB::table('users')->insert([
                'name' => $faker->firstName,
                'prenom' => $faker->lastName,
                'phone_number' => $faker->unique()->numerify('06########'),
                'DateDernierDon' => $this->getRandomDate($minDate),
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'city_id' => $cities->random(),
                'blood_group_id' => $bloodGroups->random(),
                'created_at' => now(),
            ]);
        }
    }

    /**
     * Get a random date between $minDate and today.
     *
     * @param  \Carbon\Carbon  $minDate
     * @return \Carbon\Carbon
     */
    private function getRandomDate($minDate)
    {
        $maxDate = Carbon::today();
        return Carbon::createFromTimestamp(rand($minDate->timestamp, $maxDate->timestamp));
    }
}
