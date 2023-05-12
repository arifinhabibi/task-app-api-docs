<?php

namespace App\Http\Controllers\API;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function getDataTask(Request $request){
        $tasks = Task::all();
        return response()->json([
            'code_status' => 200,
            'msg_status' => 'Tasks has been loaded',
            'data' => $tasks
        ], 200);
    }

    public function addTask(Request $request){
        try {
            //code...
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            //throw $th;
            return response()->json([
                'code_status' => 401,
                'msg_status' => 'Unauthorized user'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'code_status' => 422,
                'msg_status' => 'Unprocessable Entity',
                'errors' => $validator->errors()
            ], 401);
        }

        Task::create($validator->validate());

        return response()->json([
            'code_status' => 200,
            'msg_status' => 'New task has been added'
        ], 200);
    }

    public function singleTask(Request $request, $taskId){
        try {
            //code...
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            //throw $th;
            return response()->json([
                'code_status' => 401,
                'msg_status' => 'Unauthorized user'
            ], 401);
        }

        $task = Task::find($taskId);

        if (!$task) {
            # code...
            return response()->json([
                'code_status' => 404,
                'msg_status' => 'Record not found'
            ], 404);
        }

        return response()->json([
            'code_status' => 200,
            'msg_status' => 'Task has been loaded',
            'data' => $task
        ], 200);
    }

    public function updateTask($taskId, Request $request){
        try {
            //code...
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            //throw $th;
            return response()->json([
                'code_status' => 401,
                'msg_status' => 'Unauthorized user'
            ], 401);
        }

        $task = Task::find($taskId);

        if (!$task) {
            # code...
            return response()->json([
                'code_status' => 404,
                'msg_status' => 'Record not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'code_status' => 422,
                'msg_status' => 'Unprocessable Entity',
                'errors' => $validator->errors()
            ], 401);
        }

        $task->update($validator->validate());

        return response()->json([
            'code_status' => 200,
            'msg_status' => 'Task has been updated'
        ], 200);
    }

    public function deleteTask(Request $request, $taskId){
        try {
            //code...
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            //throw $th;
            return response()->json([
                'code_status' => 401,
                'msg_status' => 'Unauthorized user'
            ], 401);
        }

        $task = Task::find($taskId);

        if (!$task) {
            # code...
            return response()->json([
                'code_status' => 404,
                'msg_status' => 'Record not found'
            ], 404);
        }

        $task->delete();

        return response()->json([
            'code_status' => 200,
            'msg_status' => 'Task has been deleted'
        ], 200);
    }
}
