<?php

namespace App\Http\Controllers;

use App\Http\Requests\Taskrequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $taskService;
    public function __construct(TaskService $taskService){
        $this->taskService = $taskService;


    }
    public function index(Request $request)
    {
        $data = $this->taskService->collection($request->all());
        if (isset($data['errors'])) {
            return response()->json($data['errors'], 400);
        }
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Taskrequest $request)
    {
        $data = $this->taskService->store($request->validated());
        if (isset($data['errors'])) {
            return response()->json($data['errors'], 400);
        }
        return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id,Request $request)
    {
        $data = $this->taskService->resource($id,$request->all());
        if (isset($data['errors'])) {
            return response()->json($data['errors'], 400);
        }
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, Taskrequest $request)
    {
        $data = $this->taskService->update($id, $request->validated());
        if (isset($data['errors'])) {
            return response()->json($data['errors'], 400);
        }
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $data = $this->taskService->delete($id);
        if (isset($data['errors'])) {
            return response()->json($data['errors'], 400);
        }
        return response()->json($data, 200);
    }
}
