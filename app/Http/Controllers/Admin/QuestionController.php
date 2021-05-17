<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::orderBy('created_at','DESC')->get();
       return view('admin.question.index')->with('questions',$questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.question.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $success = Question::create([
            "category" => $request->category,
            "question" => $request->question,
            "answer" => $request->answer
        ]);

        if($success){
            $request->session('success','Question added successfully!');
        }else{
            $request->session('error','Failed to added question.');
        }

        return redirect()->route('admin.question.index');
    }

    /**
     * Display the specified resource.  
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        return view('admin.question.form')->with('question', $question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = Question::find($id);

        $question->category = $request->category;
        $question->question = $request->question;
        $question->answer = $request->answer;

        $success = $question->update();

        if($success){
            $request->session()->flash('success','Question updated successfully!');
        }else{
            $request->session()->flash('error','Failed to update question.');
        }

        return redirect()->route('admin.question.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $question = Question::find($id);
        $success = $question->delete();

        if($success){
            $request->session()->flash('success','Question deleted successfully!');
        }else{
            $request->session()->flash('error','Failed to delete question.');
        }
        return redirect()->route('admin.question.index');
    }
}
