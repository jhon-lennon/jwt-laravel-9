<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestUpdateUser;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function __construct(protected UserService $service)
    {
    }

    public function show()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user()
        ]);
    }


    public function update(RequestUpdateUser $request,)
    {

        try {
            $data = $this->service->updateService($request);

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

    public function delete()
    {
        try {
            $this->service->deleteService();

            return response()->json([
                'status' => true,
                'message' => ' User deleted successfully'
            ], 200);
        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
