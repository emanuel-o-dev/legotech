<?php

namespace App\Http\Controllers;

use App\Models\User;

class RoleController extends Controller
{
    public function toggle(User $user)
    {
        if (!$user->isAdmin()) {
            $user->role = 'ADMIN';
        } else {
            $user->role = 'USER';
        }

        $user->save();

        return back()->with('success', 'Role atualizada: ' . $user->role);
    }
}
