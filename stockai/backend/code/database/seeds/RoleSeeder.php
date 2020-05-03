<?php

use App\Models\Permissions\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['role_id' => 'ADM', 'rol_name' => 'Administrador'],
            ['role_id' => 'ATL', 'rol_name' => 'Atlética'],
            ['role_id' => 'FOR', 'rol_name' => 'Fornecedor'],
            ['role_id' => 'SOC', 'rol_name' => 'Sócio'],
        ];

        foreach ($roles as $role){
            Role::updateOrCreate(['role_id' => $role['role_id']],$role);
        }
    }
}
