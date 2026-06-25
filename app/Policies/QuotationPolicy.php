<?php

namespace App\Policies;

use App\Models\Quotation;
use App\Models\User;

class QuotationPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isCaseManager();
    }

    public function view(User $user, Quotation $quotation): bool
    {
        if ($user->isCaseManager()) return true;

        $patientUserId = $quotation->inquiry->patientProfile?->user_id
            ?? $quotation->inquiry->user_id;

        return $patientUserId === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->isCaseManager();
    }

    public function update(User $user, Quotation $quotation): bool
    {
        return $user->isCaseManager() && $quotation->status === 'draft';
    }

    public function delete(User $user, Quotation $quotation): bool
    {
        return $user->isAdmin();
    }
}
