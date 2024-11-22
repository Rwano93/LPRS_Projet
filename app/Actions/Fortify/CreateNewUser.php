<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Validation\ValidationException;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {
        Validator::make($input, [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $defaultRole = Role::find(1);

        if (!$defaultRole) {
            throw ValidationException::withMessages([
                'role' => ['Default role not found. Please check your database.'],
            ]);
        }

        return User::create([
            'nom' => $input['nom'],
            'prenom' => $input['prenom'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'ref_role' => $defaultRole->id,
        ]);
    }
}
