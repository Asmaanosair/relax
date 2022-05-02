<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user = User::where('email', 'admin@gmail.com')->first();

        // if (! $user) {
        //     return ;
        // }

        // An admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '01067770640',
            'gender' => 'male',
            'birthday' => '1995-10-10',
            'user_role' => 0,
        ]);

        // A patient
        User::create([
            'name' => 'Patient',
            'email' => 'patient@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '01067740640',
            'gender' => 'male',
            'birthday' => '1995-10-10',
            'user_role' => 2,
        ]);
    }
}
