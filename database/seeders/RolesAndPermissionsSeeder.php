<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'manage-events',
            'create-own-events',
            'edit-own-events',
            'delete-own-events',
            'view-events',
            'manage-ticket-types',
            'view-orders',
            'manage-payments',
            'check-in-attendees',
            'manage-users',
            'manage-categories',
            'manage-coupons',
        ];
        
        foreach($permissions as $permission)
        {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $organizer = Role::firstOrCreate(['name' => 'organizer']);
        $attendee = Role::firstOrCreate(['name' => 'attendee']);

        $organizer->givePermissionTo([
            'create-own-events',
            'edit-own-events',
            'delete-own-events',
            'manage-ticket-types',
            'view-orders',
            'check-in-attendees',
        ]);

        $superAdmin->givePermissionTo(Permission::all());
        $attendee->givePermissionTo(['view-events']);
    }
}
