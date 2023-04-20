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

    }

    public function update(Task $task, Request $request, ){

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'completed' => 'required'
        ]);

        $task->update($request->all());

        $request->user()->save();

        return Redirect::route('tasks.index');
    }
}
