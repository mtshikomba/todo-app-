<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index(){
        return Inertia::render('Tasks', [
            'tasks' => Task::all()
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'completed' => 'required'
        ]);

        $task = new Task();

        $task->fill($request->all());

        $task->user()->associate(auth()->user());

        $task->save();

        return Redirect::route('tasks.index');
    }

    public function update(Task $task, Request $request, ){

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'completed' => 'required'
        ]);

        $task->update($request->all());

        return Redirect::route('tasks.index');
    }
}
