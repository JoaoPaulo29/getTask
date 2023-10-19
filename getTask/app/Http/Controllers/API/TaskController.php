<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskRequest;
use App\Models\Task;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * 
     * 
     *
     * @param TaskRequest $request
     * @function createTask
     * @return void
     * Esta função serve para criar as para o usuario
     */
    public function createTask(TaskRequest $request){ 
       try {
            $user = User::findOrFail($request->input('user_id')); 
            if ($user) { 
                $task =  new Task();
                $task->title = $request->input('title');
                $task->due_date = $request->input('due_date');
                $task->description = $request->input('description');
                $task->status = $request->input('status');
                $task->priority = $request->input('priority'); 
                $task->user_id = $user->id;
                $task->save();
                 return response(['message' => 'Task created with sucess', 'task' => $task], 201);
                
            }
            return response(['message'=>'user dont exist'],404);
       } catch (Exception $e) {
            response(['message' => 'Task don´t created'], 500);
       }
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     * Serve para mostrar uma tarefa de um ususario
     */
    public function show($id){ 
        $task = Task::with('user')->where('id', '=',$id)->first();
        return response(['task'=>$task],201);
    }

    /**
     * 
     * Serve para mostrar todas as tarefas de um usuario
     */

    public function allTaskUser($user){
        $task = Task::with('user')->where('user_id','=',$user)->get();
        return response(['tasks'=>$task], 200);
    }

    /**
     * 
     * Serve para mostrar as tarefas de um determinado estado de um usuario passando o estado
     *
     * @param Request $request
     * @param [type] $user
     * @return void
     */
    public function allForStatusUser(Request $request,$user){
        $task = Task::with('user')->where('user_id','=',$user)->where('status','=',$request->status)->get();
        return response(['tasks'=>$task], 200);
    }

    /**
     * Undocumented function
     *Serve Para mostrar todas as tarefas de um determinado estado de todos os usuarios passando um estado
     * @param Request $request
     * @return void
     */
    public function allForStatus(Request $request){
        $task = Task::with('user')->where('status','=',$request->status)->get();
        return response(['tasks'=>$task], 200);
    }

    /**
     * Undocumented function
     * Serve para muadr o estado de uma tafefa
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function changeStatus(Request $request, $id){
        $task = Task::findOrFail($id);
        if($task){ 
            $task->status = $request->input('status');
            $task->save();
            return response(['message'=>'Task updated with sucess'],200);
        
        }
        return response(['message'=>'Task dont created'],400);

    }
}
