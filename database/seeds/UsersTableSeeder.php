<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();
        $ownerRole = Role::where('name', 'owner')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $usersRole = Role::where('name', 'user')->first();

        $owner = User::create([
            'profile' => 'logo.png',
            'name' => 'Owner Winih',
            'username' => 'owner winih',
            'email' => 'owner@gmail.com',
            'phone' => '089123098645',
            'address' => 'Bandung',
            'password' => Hash::make('password')
        ]);
        $admin = User::create([
            'profile' => 'logo.png',
            'name' => 'admin Winih',
            'username' => 'admin winih',
            'email' => 'admin@gmail.com',
            'phone' => '089123098673',
            'address' => 'Banyumas',
            'password' => Hash::make('password')
        ]);
        $user = User::create([
            'profile' => 'logo.png',
            'name' => 'user Winih',
            'username' => 'user winih',
            'email' => 'user@gmail.com',
            'phone' => '089123098817',
            'address' => 'Banjar',
            'password' => Hash::make('password')
        ]);
        $owner->roles()->attach($ownerRole);
        $admin->roles()->attach($adminRole);
        $user->roles()->attach($usersRole);
    }
}
