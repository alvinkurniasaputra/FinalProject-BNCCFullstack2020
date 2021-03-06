<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Question;
use App\Answer;
use App\User;
use App\AnswerComment;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sum = Question::count();
        if ($sum > 15)
            $question = Question::orderBy('created_at','desc')->paginate(15);
        else
            $question = Question::orderBy('created_at','desc')->paginate($sum);
        $id = Auth::id();
        return view('forum.questions.index', compact('question','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forum.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:15|max:255',
            'content' => 'required|min:30|max:255'],
        ['content.required' => 'The body field is required.',
        'content.min' => 'The body must be at least 30 characters.',
        'content.max' => 'The body may not be greater than 255 characters.'
    ]);

        $question = new Question;
        $question->title = $request->title;
        $question->content = $request->content;
        $question->user_id = $request->user()->id;
        $res = $question->save();

        return redirect('/questions');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id); //$pertanyaan = Pertanyaan::with('jawaban')->find($id);
        $answer = Question::find($id)->answer()->orderBy('created_at','desc')->get();
        $id = Auth::id();

        return view('forum.questions.show', compact('question','answer','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::where('id',$id)->first();

        if($question->user_id == Auth::id())
        return view('forum.questions.edit', compact('question'));

        else
        return redirect(url("/questions/$id"));
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
            'title' => 'required|min:15|max:100',
            'content' => 'required|min:30|max:255'],
            ['content.required' => 'The body field is required.',
            'content.min' => 'The body must be at least 30 characters.',
            'content.max' => 'The body may not be greater than 255 characters.'
        ]);

        $question = Question::where('id',$id)->update(["title" => $request["title"],"content" => $request["content"]]);

        return redirect(url("/questions/$id"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Answer::where('question_id','=',$id)->get();
        foreach ($comment as $key => $item) {
            $item->answerComment()->delete();
        }
        Question::find($id)->questionComment()->delete();
        Question::find($id)->answer()->delete();
        Question::where('id',$id)->delete();

        return redirect('/questions');
    }

    public function closeThread($id){
        $question = Question::where('id',$id)->update(["close_thread" => 1]);

        return redirect()->back();
    }
}
