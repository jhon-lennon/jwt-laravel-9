<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;


class UserService
{

    public function __construct(protected UserRepository $repository)
    {
    }



    public function updateService($request)
    {
        if ($request->email != Auth::user()->email) {
            if ($this->repository->getUserByEmail($request->email)->exists()) {
                throw new InvalidArgumentException('Email já está em uso');
            } else {
                return $this->repository->update($request);
            }
        } else {

            return $this->repository->update($request);
        }
    }

    public function deleteService()
    {
        return $this->repository->destroy();
    }
}
