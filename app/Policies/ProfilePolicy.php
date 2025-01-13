<?php

namespace App\Policies;

use App\Models\User;

class ProfilePolicy
{
    public function update(User $user, User $profile): bool
    {
        return $user->id == $profile->id;
    }

    public function delete(User $user, User $profile): bool
    {
        return $user->id == $profile->id;
    }
}
