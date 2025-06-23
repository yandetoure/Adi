<?php declare(strict_types=1); 

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $superAdmin = Role::create(['name' => 'super-admin']);
        $admin = Role::create(['name' => 'admin']);
        $assistant = Role::create(['name' => 'assistant']);
        $client = Role::create(['name' => 'client']);

        // Create permissions
        $permissions = [
            // User management
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',
            
            // Product management
            'view-products',
            'create-products',
            'edit-products',
            'delete-products',
            
            // Category management
            'view-categories',
            'create-categories',
            'edit-categories',
            'delete-categories',
            
            // Order management
            'view-orders',
            'create-orders',
            'edit-orders',
            'delete-orders',
            'process-orders',
            
            // System management
            'view-settings',
            'edit-settings',
            'view-reports',
            'view-logs',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to roles
        $superAdmin->givePermissionTo(Permission::all());
        
        $admin->givePermissionTo([
            'view-users', 'create-users', 'edit-users',
            'view-products', 'create-products', 'edit-products', 'delete-products',
            'view-categories', 'create-categories', 'edit-categories', 'delete-categories',
            'view-orders', 'edit-orders', 'process-orders',
            'view-settings', 'edit-settings', 'view-reports', 'view-logs',
        ]);
        
        $assistant->givePermissionTo([
            'view-products', 'edit-products',
            'view-categories', 'edit-categories',
            'view-orders', 'edit-orders', 'process-orders',
            'view-reports',
        ]);
        
        $client->givePermissionTo([
            'view-products',
            'view-categories',
            'create-orders',
            'view-orders',
        ]);
    }
}
