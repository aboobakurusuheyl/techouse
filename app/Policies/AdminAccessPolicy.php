<?php

namespace App\Policies;

use App\Models\User;

class AdminAccessPolicy
{
    /**
     * Determine if the user can access the admin panel.
     */
    public function viewAny(User $user): bool
    {
        return true; // Allow all authenticated users to access admin
    }

    /**
     * Determine if the user can view the admin dashboard.
     */
    public function view(User $user): bool
    {
        return true; // Allow all authenticated users to view admin
    }
}
