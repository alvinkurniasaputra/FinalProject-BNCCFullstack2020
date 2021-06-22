<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Answer;
use App\Question;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $validatedData = $request->validate([
            'ans_content' => 'required|min:30|max:255'],
            ['ans_content.required' => 'The body field is required.',
            'ans_content.min' => 'The body must be at least 30 characters.',
            'ans_content.max' => 'The body may not be greater than 255 characters.'
        ]);


        $answer = new Answer;
        $answer->content = $request->ans_content;
        $answer->question_id = $id;
        $answer->user_id = $request->user()->id;
        $res = $answer->save();

        return redirect()->back();

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
    public function edit($idp,$idj)
    {
        $question = Question::where('id',$idp)->first();
        $answer = Answer::where('id',$idj)->first();
        return view('forum.answers.edit', compact('question','answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idp, $idj)
    {
        $validatedData = $request->validate([
            'content' => 'required|min:30|max:255'],
            ['content.required' => 'The body field is required.',
            'content.min' => 'The body must be at least 30 characters.',
            'content.max' => 'The body may not be greater than 255 characters.'
        ]);

        $answer = Answer::where('id',$idj)->update(["content" => $request["content"]]);

        return redirect(url("/questions/$idp"));
        // return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Answer::find($id)->answerComment()->delete();
        $answer = Answer::find($id)->delete();

        return redirect()->back();
    }
}
