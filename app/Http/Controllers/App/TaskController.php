<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return response()->json([
            'status_code' => 200,
            'message' => 'Tasks retrieved successfully',
            'data' => auth()->user()->tasks()->get()
        ]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
            'completed' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'message' => 'Bad Request',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            \DB::beginTransaction();
            $task = auth()->user()->tasks()->create($validator->validated());
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();

            return response()->json([
                'status_code' => 500,
                'message' => 'Internal Server Error',
                'errors' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status_code' => 201,
            'message' => 'Task created successfully',
            'data' => $task
        ], 201);
    }

    public function destroy($id)
    {
        $task = auth()->user()->tasks()->find($id);
        if (!$task) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Task not found'
            ], 404);
        }

        try {
            \DB::beginTransaction();
            $task->delete();
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();

            return response()->json([
                'status_code' => 500,
                'message' => 'Internal Server Error',
                'errors' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Task deleted successfully'
        ]);
    }

    public function show($id)
    {
        $task = auth()->user()->tasks()->find($id);
        if (!$task) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Task not found'
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Task retrieved successfully',
            'data' => $task
        ]);
    }

    public function update(Request $request, $id)
    {
        $task = auth()->user()->tasks()->find($id);
        if (!$task) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Task not found'
            ], 404);
        }
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
            'completed' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'message' => 'Bad Request',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            \DB::beginTransaction();
            $task->update($validator->validated());
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();

            return response()->json([
                'status_code' => 500,
                'message' => 'Internal Server Error',
                'errors' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Task updated successfully',
            'data' => $task
        ]);
    }
}
