<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     * @return User
     */
    public function create(array $input)
    {

        Validator::make($input, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'expert' => 'integer|boolean|min:0|max:1',
            'expert_file' => 'mimes:png,jpg,jpeg,pdf|max:2048',
        ])->validate();

        return User::create([
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'email' => $input['email'],
            'username' => $input['username'],
            'password' => Hash::make($input['password']),
            'expert' => !isset($input['expert']) ? 0 : 1,
            'expert_file' => !empty($input['expert_file']) ? $input['expert_file']->getClientOriginalName() : null,
        ]);
    }
}
