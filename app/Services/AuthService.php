<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class AuthService
{
    public function __construct(protected AuthRepository $repository)
    {
    }

    public function registerService($request)
    {
        return $this->repository->store($request);
    }

    public function loginService($request)
    {

        if(!Auth::attempt($request->only(['email', 'password']))){

            throw new InvalidArgumentException('Email & Password does not match with our record');
        }

        return $this->repository->getUser($request->email);
    }

}
