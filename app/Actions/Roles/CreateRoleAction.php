<?php

namespace App\Actions\Roles;

use App\Models\Role;
use Illuminate\Support\Facades\DB;

class CreateRoleAction
{
    public function execute(array $data): Role
    {
        return DB::transaction(function() use ($data) {
            // dd($data);
            $role = Role::create([
                // 'tenant_id'     => 1,
                'name'          => $data['name'],
                'description'   => $data['description']
            ]);

            // $roleId->id;

            // $role = Role::findOrFail($roleId);

            $role->permissions()->attach($data['permissions']);

        });
    }
}