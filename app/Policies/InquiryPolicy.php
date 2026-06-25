<?php

namespace App\Policies;

use App\Models\Inquiry;
use App\Models\User;

class InquiryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isCaseManager();
    }

    public function view(User $user, Inquiry $inquiry): bool
    {
        return $user->isCaseManager() || $inquiry->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->isCaseManager();
    }

    public function update(User $user, Inquiry $inquiry): bool
    {
        return $user->isCaseManager();
    }

    public function delete(User $user, Inquiry $inquiry): bool
    {
        return $user->isAdmin();
    }
}
