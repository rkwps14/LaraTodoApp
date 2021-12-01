<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    
    public function create(Request $request){
        
        $todo = new Todo;
        $todo->category_id = $request->category_id;
        $todo->name = $request->name;

        $todo->save();

        $todo->category_name = $todo->category->name;
        $todo->timestamp = date('jS, F', strtotime($todo->created_at));
        
        return response()->json($todo);

    }

    
}
