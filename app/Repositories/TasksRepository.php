<?php

namespace App\Repositories;

use App\Models\User;

class TasksRepository
{
    public function __construct(protected User $model)
    {
    }
    
    public function store($request){

        $post = auth()->user()->tasks()->create([

            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'status' => 0
        ]);

        return $post;
   
       }

    public function update($request, $id){

     $task = auth()->user()->tasks()->find($id);

     $task->title = $request->exists('title') ? $request->title : $task->title;
     $task->description = $request->exists('description') ? $request->description : $task->description;
     $task->status = $request->exists('status') ? $request->status : $task->status;
     $task->date = $request->exists('date') ? $request->date : $task->date;


     $task->save();

     return $task;

    }


       public function destroy($id){

        auth()->user()->tasks()->find($id)->delete();
       }
}
