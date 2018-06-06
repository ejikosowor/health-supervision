<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('users')->insert(array(
            array('name' => $faker->name, 'username' => 'zulu001','email' => $faker->unique()->safeEmail, 'password' => bcrypt('904310813'), 'role_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => $faker->name, 'username' => 'carvalli', 'email' => $faker->unique()->safeEmail, 'password' => bcrypt('904310813'), 'role_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => $faker->name, 'username' => 'supervisor1', 'email' => $faker->unique()->safeEmail, 'password' => bcrypt('904310813'), 'role_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => $faker->name, 'username' => 'supervisor2', 'email' => $faker->unique()->safeEmail, 'password' => bcrypt('904310813'), 'role_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => $faker->name, 'username' => 'supervisor3', 'email' => $faker->unique()->safeEmail, 'password' => bcrypt('904310813'), 'role_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => $faker->name, 'username' => 'supervisor4', 'email' => $faker->unique()->safeEmail, 'password' => bcrypt('904310813'), 'role_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => $faker->name, 'username' => 'supervisor5', 'email' => $faker->unique()->safeEmail, 'password' => bcrypt('904310813'), 'role_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => $faker->name, 'username' => 'supervisor6', 'email' => $faker->unique()->safeEmail, 'password' => bcrypt('904310813'), 'role_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => $faker->name, 'username' => 'supervisor7', 'email' => $faker->unique()->safeEmail, 'password' => bcrypt('904310813'), 'role_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => $faker->name, 'username' => 'chmt1', 'email' => $faker->unique()->safeEmail, 'password' => bcrypt('904310813'), 'role_id' => 3, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => $faker->name, 'username' => 'healthrep1', 'email' => $faker->unique()->safeEmail, 'password' => bcrypt('904310813'), 'role_id' => 4, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'))
        ));
    }
}