<?php declare(strict_types=1); 

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::updateOrCreate(
            ['email' => 'admin@adi.com'],
            [
                'name' => 'Super Admin',
                'phone' => '+33123456789',
                'password' => Hash::make('password'),
                'status' => 'active',
            ]
        );

        $superAdmin->assignRole('super-admin');

        // Créer aussi un utilisateur client de test
        $client = User::updateOrCreate(
            ['email' => 'client@adi.com'],
            [
                'name' => 'Client Test',
                'phone' => '+33987654321',
                'password' => Hash::make('password'),
                'status' => 'active',
            ]
        );

        $client->assignRole('client');
    }
}
