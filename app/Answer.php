<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';
    public $timestamps = true;

    protected $fillable = [
        'content','user_id','question_id','created_at','updated_at'
    ];

    protected $hidden = [];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function question()
    {
        return $this->belongsTo('App\Question','question_id','id');
    }

    public function answerComment()
    {
        return $this->hasMany('App\AnswerComment','answer_id','id');
    }
}
