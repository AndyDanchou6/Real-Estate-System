<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'firstName' => 'Andy',
            'middleName' => 'Levi',
            'lastName' => 'Danchou',
            'email' => 'agent@realestate.com',
            'password' => Hash::make('andydanch0u'),
            'address' => 'Private',
            'phoneNo' => 'Private',
            'role' => 'agent',
            'profileImg' => '/storage/img/agent/danchou.jpg',
            'occupation' => 'Real Estate Agent'
        ]);
    }
}
