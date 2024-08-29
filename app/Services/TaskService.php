<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    /**
     * Create a new class instance.
     */
    protected $taskObject;
    public function __construct()
    {
        $this->taskObject = new Task;
        
    }
    public function collection (){
        return $this->taskObject->get->all();
        
    }
    public function store($inputs)
    {
        DB::beginTransaction();
        $task = $this->taskObject->create([
            'name' => $inputs['name'],
            'type' => $inputs['type'],
            'description' => $inputs['description'],
            $img = $inputs['image'];
            $ext = $img->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $img->move(storage_path('app/public/assets'), $imageName);
            'image' => $imageName,
            'completed'=> $inputs['completed'],
        ]);
       
        DB::commit();
        $task = [
            'status' => true,
            'message' => "Image uploaded successfully",
            'path' => asset('storage/assets/' . $imageName),
            'data' => $image
        ];
    
    return $task;
       
    }
    public function resource($id)
    {
        $task = $this->taskObject->findOrFail($id);
       
        return $task;
    }

    public function update($id, $inputs)
    {
        $task = $this->taskObject->findOrFail($id);
        $task->update($inputs);
        $success['message'] = "Task Updated successfully";
        return $success;
    }

    public function delete($id)
    {
        $task = $this->taskObject->findOrFail($id);
        $task->delete();
       
        $success['message'] = "Task deleted successfully";
        return $success;
    }
}
