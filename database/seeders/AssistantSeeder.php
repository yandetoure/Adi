<?php declare(strict_types=1); 

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class AssistantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer le rôle assistant s'il n'existe pas
        $assistantRole = Role::firstOrCreate(['name' => 'assistant']);

        // Créer les permissions pour l'assistant
        $permissions = [
            // Permissions pour les commandes
            'view orders',
            'edit orders',
            'update order status',
            
            // Permissions pour les produits
            'view products',
            'create products',
            'edit products',
            'delete products',
            
            // Permissions pour les catégories
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',
            
            // Permissions pour les utilisateurs (lecture seule)
            'view users',
            
            // Permissions pour le dashboard
            'view dashboard',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assigner les permissions au rôle assistant
        $assistantRole->givePermissionTo($permissions);

        // Créer l'utilisateur assistant
        $assistant = User::firstOrCreate(
            ['email' => 'assistant@adi.com'],
            [
                'name' => 'Assistant ADI',
                'email' => 'assistant@adi.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Assigner le rôle assistant à l'utilisateur
        $assistant->assignRole('assistant');

        $this->command->info('Assistant créé avec succès!');
        $this->command->info('Email: assistant@adi-informatique.com');
        $this->command->info('Mot de passe: password');
    }
}
