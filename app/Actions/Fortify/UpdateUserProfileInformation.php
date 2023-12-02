<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation {
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(User $user, array $input): void {
        Validator::make($input, [
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'string', 'max:128'],
            'role'  => ['string'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email && $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name'  => $input['name'],
                'email' => $input['email'],
                'role'  => $this->extractRole($input['role']),
                'phone' => $input['phone'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void {
        $user->forceFill([
            'name'              => $input['name'],
            'email'             => $input['email'],
            'phone'             => $input['phone'],
            'role'              => $this->extractRole($input['role']),
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }

    protected function extractRole(string|null $value): string {
        return empty($value) ? 'user' : $value;
    }
}
