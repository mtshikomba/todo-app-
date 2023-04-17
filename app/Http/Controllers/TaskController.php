<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index(){
        return Inertia::render('Task/Tasks', [
            'tasks' => Task::all()
        ]);
    }

    public function store(Request $request){

    }

    public function update(Request $request){

    }
}
