<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRegistrationAction
{

    /**
     * @param array $registerData
     * @return mixed
     */
    public static  function execute(array $registerData)
    {
        $user = User::create(['name' => $registerData['name'], 'email' => $registerData['email'], 'password' => Hash::make($registerData['email'])]);
        return $user;
    }
}
