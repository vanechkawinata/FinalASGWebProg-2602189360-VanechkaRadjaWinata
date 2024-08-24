<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create('en_US');

        for ($i = 0; $i < 20; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'password' => Hash::make('123456789'),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'hobbies' => implode(', ', $faker->randomElements(['sport', 'art', 'books', 'math', 'music'], 3)), 
                'number' => $faker->phoneNumber(),
                'has_paid' => 1,
                'register_price' => rand(100000, 125000),
                'profile_path' => 'images/'.$faker->numberBetween(1, 3).'.jpg',
            ]);
        }

        for ($i = 0; $i < 20; $i++) {
            $sender_id = $faker->numberBetween(1, 20);
            $receiver_id = $faker->numberBetween(1, 20);

            while ($sender_id === $receiver_id) {
                $receiver_id = $faker->numberBetween(1, 20);
            }

            DB::table('friend_request')->insert([
                'sender_id' => $sender_id,
                'receiver_id' => $receiver_id
            ]);
        }

        for ($i = 0; $i < 20; $i++) {
            $user_id = $faker->numberBetween(1, 20);
            $friend_id = $faker->numberBetween(1, 20);

            while ($user_id === $friend_id) {
                $friend_id = $faker->numberBetween(1, 20);
            }

            DB::table('friends')->insert([
                'user_id' => $user_id,
                'friend_id' => $friend_id
            ]);
        }
    }
}
