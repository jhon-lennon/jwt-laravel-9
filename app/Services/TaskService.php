<?php

namespace App\Services;

use App\Repositories\TasksRepository;
use InvalidArgumentException;


class TaskService 
{

    public function __construct(protected TasksRepository $repository)
    {
    }

    public function CreateService($request)
    {

        return $this->repository->store($request);
    }

    public function updateService($request, $id)
    {

        if (auth()->user()->tasks()->find($id) == null) {
            throw new InvalidArgumentException('Not Found');
        };

        return $this->repository->update($request, $id);
    }

    public function deleteService($id)
    {

        if (auth()->user()->tasks()->find($id) == null) {
            throw new InvalidArgumentException('Not Found');
        };

        return $this->repository->destroy($id);
    }
}
