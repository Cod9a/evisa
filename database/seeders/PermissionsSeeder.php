<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Carbon\Carbon;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role1 = Role::create(['guard_name' => 'web', 'name' => 'client']);
        $role2 = Role::create(['guard_name' => 'web', 'name' => 'agent']);
        $role3 = Role::create(['guard_name' => 'web', 'name' => 'frontal-agent']);
        $role4 = Role::create(['guard_name' => 'web', 'name' => 'admin']);
        $role5 = Role::create(['guard_name' => 'web', 'name' => 'super-admin']);

        Permission::create(['guard_name' => 'web', 'name' => 'create user']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit user']);
        Permission::create(['guard_name' => 'web', 'name' => 'show user']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete user']);

        Permission::create(['guard_name' => 'web', 'name' => 'create center']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit center']);
        Permission::create(['guard_name' => 'web', 'name' => 'show center']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete center']);

        Permission::create(['guard_name' => 'web', 'name' => 'show dossier']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete dossier']);
        Permission::create(['guard_name' => 'web', 'name' => 'rejected dossier']);
        Permission::create(['guard_name' => 'web', 'name' => 'validated dossier']);

        Permission::create(['guard_name' => 'web', 'name' => 'apply for visa']);
        Permission::create(['guard_name' => 'web', 'name' => 'make payment']);
        Permission::create(['guard_name' => 'web', 'name' => 'create dossier']);

        //Administrateur
        $role3->givePermissionTo('edit user');
        $role3->givePermissionTo('delete user');
        $role3->givePermissionTo('create user');
        $role3->givePermissionTo('show user');

        $role3->givePermissionTo('edit center');
        $role3->givePermissionTo('delete center');
        $role3->givePermissionTo('create center');
        $role3->givePermissionTo('show center');

        //Agent
        $role2->givePermissionTo('validated dossier');
        $role2->givePermissionTo('delete dossier');
        $role2->givePermissionTo('rejected dossier');
        $role2->givePermissionTo('show dossier');

        //Client
        $role1->givePermissionTo('make payment');
        $role1->givePermissionTo('create dossier');
        $role1->givePermissionTo('apply for visa');


        $user1 = \App\Models\User::factory()->create([
            'name' => 'DIEP',
            'surname' => 'Thanh',
            'email' => 'thanhdiep@evisacameroun.com',
            'country' => 'FR',
            'sex' => 'M',
            'password' => bcrypt('super-administrator'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user1->syncRoles([$role5]);


        $user2 = \App\Models\User::factory()->create([
            'name' => 'LAINE',
            'surname' => 'Maxine',
            'email' => 'maxinelaine@evisacameroun.com',
            'country' => 'BJ',
            'sex' => 'F',
            'password' => bcrypt('super-administrator'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user2->syncRoles([$role5]);

        $user3 = \App\Models\User::factory()->create([
            'name' => 'CODJO',
            'surname' => 'Forester',
            'email' => 'foranster04@evisacameroun.com',
            'country' => 'BJ',
            'sex' => 'M',
            'password' => bcrypt('super-administrator'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user3->syncRoles([$role5]);

        $user4 = \App\Models\User::factory()->create([
            'name' => 'FRANCE',
            'surname' => 'Admin',
            'email' => 'admin@france.com',
            'country' => 'FR',
            'sex' => 'M',
            'center_id' => 1,
            'password' => bcrypt('EvCam2022'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user4->syncRoles([$role4]);

        $user5 = \App\Models\User::factory()->create([
            'name' => 'BENIN',
            'surname' => 'Admin',
            'email' => 'admin@benin.com',
            'country' => 'BJ',
            'sex' => 'F',
            'center_id' => 2,
            'password' => bcrypt('EvCam2022'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user5->syncRoles([$role4]);

        $user6 = \App\Models\User::factory()->create([
            'name' => 'AERO',
            'surname' => 'Agent',
            'email' => 'agent@aero.com',
            'country' => 'BJ',
            'sex' => 'M',
            'password' => bcrypt('EvCam2022'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user6->syncRoles([$role3]);

        $user8 = \App\Models\User::factory()->create([
            'name' => 'France',
            'surname' => 'Agent',
            'email' => 'agent@france.com',
            'country' => 'CM',
            'sex' => 'M',
            'center_id' => 1,
            'password' => bcrypt('EvCam2022'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user8->syncRoles([$role2]);

        $user9 = \App\Models\User::factory()->create([
            'name' => 'BENIN',
            'surname' => 'Agent',
            'email' => 'agent@benin.com',
            'country' => 'CM',
            'sex' => 'F',
            'center_id' => 2,
            'password' => bcrypt('EvCam2022'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user9->syncRoles([$role2]);

        $user10 = \App\Models\User::factory()->create([
            'name' => 'Monsieur',
            'surname' => 'Client',
            'email' => 'client@gmail.com',
            'country' => 'BJ',
            'sex' => 'M',
            'password' => bcrypt('client'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user10->assignRole([$role1]);

        $user11 = \App\Models\User::factory()->create([
            'name' => 'Monsieur',
            'surname' => 'Client2',
            'email' => 'client2@gmail.com',
            'country' => 'BJ',
            'sex' => 'F',
            'password' => bcrypt('client'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user11->assignRole([$role1]);
    }
}
