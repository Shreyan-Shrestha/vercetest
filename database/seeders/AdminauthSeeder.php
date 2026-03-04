<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Adminauth;
use Illuminate\Support\Facades\Hash;

class AdminauthSeeder extends Seeder
{
    public function run(): void
    {
        Adminauth::create([
            'uname' => 'defortadmin',
            'password' => Hash::make('pne@ia$lls83'),
        ]);
    }
}