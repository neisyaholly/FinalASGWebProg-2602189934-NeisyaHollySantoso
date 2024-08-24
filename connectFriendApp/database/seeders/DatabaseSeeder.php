<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        $faker = Faker::create('en_EN');

        for ($i = 0; $i < 10; $i++) {
            \DB::table('users')->insert([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'password' => Hash::make('1234567890'),
                'gender' => $faker->randomElement($array = ['Male', 'Female']),
                'hobbies' => implode(', ', $faker->randomElements(['Photography', 'Dance', 'Painting', 'Drawing', 'Knitting', 'Reading'], rand(3, 6))),
                'instagram_username' => 'http://www.instagram.com/',
                'mobile_number' => $faker->phoneNumber(),
                'profile_path' => 'profile_pic/' . $faker->numberBetween(1, 3) . '.jpg',
                'register_price' => rand(25000, 50000),
                'has_paid' => 1,
            ]);
        }

        for ($i = 0; $i < 20; $i++) {
            $sender_id = $faker->numberBetween(1, 10);
            $receiver_id = $faker->numberBetween(1, 10);

            while ($sender_id === $receiver_id) {
                $receiver_id = $faker->numberBetween(1, 10);
            }

            \DB::table('friend_requests')->insert([
                'sender_id' => $sender_id,
                'receiver_id' => $receiver_id
            ]);
        }

        for ($i = 0; $i < 20; $i++) {
            $user_id = $faker->numberBetween(1, 10);
            $friend_id = $faker->numberBetween(1, 10);

            while ($user_id === $friend_id) {
                $friend_id = $faker->numberBetween(1, 10);
            }

            \DB::table('friends')->insert([
                'user_id' => $user_id,
                'friend_id' => $friend_id
            ]);
        }

    }
}
