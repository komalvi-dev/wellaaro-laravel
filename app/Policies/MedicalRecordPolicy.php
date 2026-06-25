<?php

namespace App\Policies;

use App\Models\MedicalRecord;
use App\Models\User;

class MedicalRecordPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, MedicalRecord $record): bool
    {
        return $user->isCaseManager()
            || $record->patientProfile->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function delete(User $user, MedicalRecord $record): bool
    {
        return $user->isCaseManager()
            || $record->patientProfile->user_id === $user->id;
    }
}
