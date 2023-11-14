<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class UserSeeder extends Seeder
{
    /**php
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = "Evan Tanuwijaya";
        $user->email = "evantanu@gmail.com";
        $user->password = Hash::make('Evan1234');
        $user->phone='08123456789';
        $user-> age = 12;
        $user->save();

        $user = new User();
        $user->name = "Midas_Touche";
        $user->email = "Midas_Touche@gmail.com";
        $user->password = Hash::make('MidasIamGodl1111111111');
        $user->phone='0812333333333';
        $user-> age = 9;
        $user->save();
    }
}
