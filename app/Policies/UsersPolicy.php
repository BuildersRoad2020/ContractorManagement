<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsersPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function admin(User $user)
    {
        //
        $users = $user->roleuser()->pluck('roles_id')->toarray();
        foreach ($users as $key => $id) {
            if ($id == 1 )
                return true;
                break;
        }
    }

    public function vendor(User $user)
    {
        $users = $user->roleuser()->pluck('roles_id')->toarray();
        foreach ($users as $key => $id) {
            if ($id == 2)
                return true;
        }
    }

    public function adminvendor(User $user)
    {
        $users = $user->roleuser()->pluck('roles_id')->toarray();
        foreach ($users as $key => $id) {
            if ($id == 1)
            return true;
            else if ($id == 2)
                return true;
            break;
        }
    }

    public function technician(User $user)
    {
        $users = $user->Roles()->pluck('id');
        foreach ($users as $key => $id) {
            if ($id == 3)
                return true;
        }
    }
}
