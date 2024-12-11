<?php

namespace App\Http\Controllers\API;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class TaskController extends BaseController
{
    public function index(): JsonResponse
    {
        $tasks = Task::all();
        return response()->json($tasks);
        return $this->sendResponse(TaskController::collection($products), 'Tasks retrieved successfully.');
    }

    public function store(Request $request): JsonResponse
    {
        $tasksData = $request->all();
        $tasks = [];
        $errors = [];
        foreach ($tasksData as $index => $taskData) {
            $validator = Validator::make($taskData, ['title' => 'required|string|max:255', 'description' => 'nullable|string',]);
            if ($validator->fails()) {
                $errors[$index] = $validator->errors()->all();
            } else {
                $task = new Task();
                $task->title = $taskData['title'];
                $task->description = $taskData['description'];
                $task->user_id = Auth::id();
                $task->completed = false;
                $task->save();
                $tasks[] = $task;
            }
        }
        if (!empty($errors)) {
            return response()->json(['errors' => $errors, 'tasks' => $tasks,], 422); // Unprocessable Entity 
        }
        return response()->json($tasks, 201);
    }

    public function show(Task $task): JsonResponse
    {
        if ($task->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($task);
    }

    public function update(Request $request, Task $task): JsonResponse
    {
        if ($task->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean',
        ]);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->completed = $request->completed;
        $task->save();

        return response()->json($task);
    }

    public function destroy(Task $task): JsonResponse
    {
        if ($task->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $task->delete();
        return response()->json([
            'message' => 'Task deleted successfully',
            'task' => $task,
        ], 200);
    }
}
