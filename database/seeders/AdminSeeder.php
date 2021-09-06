<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'joel2play',
                'email'=> 'joelriemersma03@gmail.com',
                'password' => Hash::make('119875123Ja!'),
                'role_id' => 1,
            ]
        );
    }
}