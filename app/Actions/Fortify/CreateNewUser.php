<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers {
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(array $input): User {
        Validator::make($input, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'    => ['required', 'string', 'max:128'],
            'password' => $this->passwordRules(),
            //            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'name'     => $input['name'],
            'email'    => $input['email'],
            'phone'    => $input['phone'],
            'role'     => 'user',
            'password' => Hash::make($input['password']),
        ]);
    }
}
