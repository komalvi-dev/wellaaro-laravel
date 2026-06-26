<?php

namespace App\Hashing;

use Illuminate\Hashing\BcryptHasher;

class RailsCompatibleHasher extends BcryptHasher
{
    // Rails uses $2a$ prefix; Laravel expects $2y$. Both are BCrypt and
    // password_verify() handles both — we just skip the algorithm check.
    public function check($value, $hashedValue, array $options = []): bool
    {
        if (empty($hashedValue)) {
            return false;
        }

        return password_verify($value, $hashedValue);
    }

    public function needsRehash($hashedValue, array $options = []): bool
    {
        // Rehash $2a$ passwords to $2y$ on next login
        return str_starts_with($hashedValue, '$2a$') || parent::needsRehash($hashedValue, $options);
    }
}
