<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
    public function __construct(protected User $model)
    {
    }
    public function store($request)
    {
        return $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    }

    public function getUser($email){

        return $this->model->where('email', $email)->first();
    }
}
