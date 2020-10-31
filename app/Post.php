<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table="posts"; //ukoliko je ime modela razlicito od imena table u bazi
    protected $id="id"; //ukoliko primarni kljuc nije kolona id

    public $timestamps=true; //kolone created_at i updated_at se automatski popunjavaju

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
