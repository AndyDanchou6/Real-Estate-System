<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client = User::create([
            'firstName' => 'Melchard',
            'middleName' => 'Deraco',
            'lastName' => 'Lina',
            'email' => 'client@realestate.com',
            'password' => Hash::make('andydanch0u'),
            'address' => 'Brgy. Hampangan Hilongos Leyte',
            'phoneNo' => '09307696919',
            'role' => 'client',
            'profileImg' => '/storage/img/client/danchou.jpg',
            'occupation' => 'Business Owner'
        ]);
    }
}
