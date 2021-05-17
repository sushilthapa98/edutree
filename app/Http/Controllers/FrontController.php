<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        $questions = Question::orderBy('created_at','DESC')->get();
        return view('welcome')->with('questions',$questions);
    }
}
