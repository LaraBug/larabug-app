<?php

namespace App\Utilities;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class InviteToken
{
    public function generate(User $user): string
    {
        return Crypt::encrypt([
            'id' => $user->id,
            'expires' => now()->addMinutes(5)->timestamp
        ]);
    }

    public function verify(string $token): bool
    {
        if (! $decrypted = $this->decrypt($token)) {
            return false;
        }

        $user = User::find($decrypted['id']);

        return $user !== null && $decrypted['expires'] > now()->timestamp;
    }

    public function data(string $token): bool|string
    {
        $decrypted = $this->decrypt($token);

        return $decrypted['id'];
    }

    protected function decrypt(string $token): bool|array
    {
        try {
            $decrypted = Crypt::decrypt($token);
        } catch (DecryptException $e) {
            return false;
        }

        return $decrypted;
    }
}
