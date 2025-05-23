<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $pendingTasks = Task::where('completed', false)->latest()->get();
        $completedTasks = Task::where('completed', true)->latest()->get();

        return view('tasks.index', compact('pendingTasks', 'completedTasks'));
    }


    public function store(Request $request)
    {
        $request->validate(['title' => 'required|max:255']);

        Task::create($request->all());

        return redirect()->route('tasks.index')
            ->with('success', 'Tugas berhasil ditambahkan!');
    }

    public function update(Request $request, Task $task)
    {
        $completed = $request->has('completed');
        $task->update(['completed' => $completed]);

        return response()->json([
            'success' => true,
            'task' => [
                'id' => $task->id,
                'title' => $task->title,
                'completed' => $task->completed
            ]
        ]);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Tugas berhasil dihapus!');
    }

    private function getTasks()
    {
        return Task::latest()->get();
    }
}
