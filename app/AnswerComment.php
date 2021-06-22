<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerComment extends Model
{
    protected $table = 'answer_comments';
    public $timestamps = true;

    protected $fillable = [
        'content','user_id','answer_id','created_at','updated_at'
    ];

    protected $hidden = [];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function answer()
    {
        return $this->belongsTo('App\Answer','answer_id','id');
    }
}
