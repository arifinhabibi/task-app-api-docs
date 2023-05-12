<?php

namespace App\Http\Controllers\API;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function getDataTask(Request $request){
        $tasks = Task::all();
        return response()->json($tasks, 200);
    }
}
