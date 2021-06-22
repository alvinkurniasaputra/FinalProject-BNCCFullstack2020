<?php

namespace App\Http\Controllers;

use App\AnswerComment;
use Illuminate\Http\Request;

class AnswerCommentController extends Controller
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
            'content_reply' => 'required|min:15|max:255'],
            ['content_reply.required' => 'The comment field is required.',
            'content_reply.min' => 'The comment must be at least 15 characters.',
            'content_reply.max' => 'The comment may not be greater than 255 characters.'
        ]);

        $comment = new AnswerComment;
        $comment->content = $request->content_reply;
        $comment->answer_id = $id;
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
            'content_edit' => 'required|min:15|max:255'],
            ['content_edit.required' => 'The comment field is required.',
            'content_edit.min' => 'The comment must be at least 15 characters.',
            'content_edit.max' => 'The comment may not be greater than 255 characters.'
        ]);

        $answer = AnswerComment::where('id',$id)->update(["content" => $request["content_edit"]]);

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
        $comment = AnswerComment::find($id)->delete();

        return redirect()->back();
    }
}
