<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    public $timestamps = true;

    protected $fillable = [
        'title','content','user_id','created_at','updated_at'
    ];

    protected $hidden = [];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function answer()
    {
        return $this->hasMany(Answer::class,'question_id','id');
    }
}
