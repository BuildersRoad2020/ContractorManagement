<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new User();
        $user->password = '$2y$10$rhm2pp2wXz7jg5z10ca2/.NfsaXzFTPNq/q2y0ZkKSa6CBwFJYga6';
        $user->email = 'support@engagis.com';
        $user->name = 'Support Admin';
        $user->save();
        $user->RoleUser()->create(['roles_id' => '1']);
    }
}
