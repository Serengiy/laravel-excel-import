<?php

namespace App\Http\Controllers;

use App\Http\Resources\FailedRow\FailedRowResource;
use App\Http\Resources\Task\TaskResource;
use App\Models\FailedRow;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['user', 'file'])->withCount('failedRows')->paginate(2);
        $tasks = TaskResource::collection($tasks);
        return inertia('Task/Index', compact('tasks'));
    }

    public function failedRows(Task $task)
    {;
        $failedRows = FailedRow::where('task_id', $task->id)->paginate(2);
        $failedRows = FailedRowResource::collection($failedRows);
        return inertia('Task/FailedRows', compact('failedRows'));
    }

}
