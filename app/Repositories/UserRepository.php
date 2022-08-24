<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    public function __construct(protected User $model)
    {
    }

    public function update($request){

     $user = Auth::user();

     $user->name = $request->exists('name') ? $request->name : $user->name;
     $user->email = $request->exists('email') ? $request->email : $user->email;

     $user->save();

     return $user;

    }

       public function destroy(){

    
        Auth::user()->delete();
        
       }

       public function getUserByEmail($email){

        return $this->model->where('email', $email);

       }
}
