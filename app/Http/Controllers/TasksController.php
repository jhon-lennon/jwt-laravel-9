<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Exception;
use Illuminate\Http\Request;
use App\Services\TaskService;

class TasksController extends Controller
{

    public function __construct(protected TaskService $service)
    {
    }

    
    public function index()
    {
        
        try {
            //$data = $this->service->postUserService(auth()->user()->id);
            $data = auth()->user()->tasks()->get();
    
            return response()->json([
                'status' => true,
                'data' => $data
            ], 200);
    
        } catch (Exception $e) {
    
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        
        try {
            //$data = $this->service->postUserService(auth()->user()->id);
            $data = auth()->user()->tasks()->find($id);
    
            return response()->json([
                'status' => true,
                'data' => $data
            ], 200);
    
        } catch (Exception $e) {
    
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function create(RegisterTaskRequest $request)
    {
        try {

            $data = $this->service->CreateService($request);
    
            return response()->json([
                'status' => true,
                'data' => $data
            ], 200);
    
        } catch (Exception $e) {
    
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateTaskRequest $request, $id){

        try {
        $data = $this->service->updateService($request, $id);
    
        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);

    } catch (Exception $e) {

        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ], 404);
    }
    }

    public function delete($id){

        try {
        $this->service->deleteService($id);
    
        return response()->json([
            'status' => true,
            'message' => ' Task deleted successfully'
        ], 200);

    } catch (Exception $e) {

        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ], 404);
    }
    }
}
