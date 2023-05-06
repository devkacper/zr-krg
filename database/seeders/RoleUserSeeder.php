<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $rolesCount = Role::all()->count();

        foreach($users as $user) {
            RoleUser::create([
                'user_id' => $user->id,
                'role_id' => rand(1,$rolesCount)
            ]);
        }
    }
}
