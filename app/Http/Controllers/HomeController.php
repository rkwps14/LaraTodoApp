<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\Category;

class HomeController extends Controller
{

    public function index(){
        return redirect()->route('home');
    }
    public function home() {
        $todos = Todo::with('category')->orderBy('id','desc')->get();
        $categories = Category::with('todos')->get();

        return view('home', [
            'todos' => $todos,
            'categories' => $categories
        ]);
    }

    public function destroy($id) {
        // print_r($id); exit;
        $todo = Todo::where('id', $id)->firstorfail()->delete();
          echo ("User Record deleted successfully.");
          return redirect()->route('home');
    }
}
