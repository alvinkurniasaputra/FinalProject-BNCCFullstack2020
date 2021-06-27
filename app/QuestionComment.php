<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionComment extends Model
{
    protected $table = 'question_comments';
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
}
