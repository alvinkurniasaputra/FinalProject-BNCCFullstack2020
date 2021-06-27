<?php

namespace App\Http\Controllers;

use App\QuestionComment;
use Illuminate\Http\Request;

class QuestionCommentController extends Controller
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
            'question_reply' => 'required|min:15|max:255'],
            ['question_reply.required' => 'The comment field is required.',
            'question_reply.min' => 'The comment must be at least 15 characters.',
            'question_reply.max' => 'The comment may not be greater than 255 characters.'
        ]);

        $comment = new QuestionComment;
        $comment->content = $request->question_reply;
        $comment->question_id = $id;
        $comment->user_id = $request->user()->id;
        $res = $comment->save();

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
    public function edit($id)
    {
        //
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
        $validatedData = $request->validate([
            'edit_reply_question' => 'required|min:15|max:255'],
            ['edit_reply_question.required' => 'The comment field is required.',
            'edit_reply_question.min' => 'The comment must be at least 15 characters.',
            'edit_reply_question.max' => 'The comment may not be greater than 255 characters.'
        ]);

        $question = QuestionComment::where('id',$id)->update(["content" => $request["edit_reply_question"]]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = QuestionComment::find($id)->delete();

        return redirect()->back();
    }
}
