<?php

namespace App;


use App\User;
use Illuminate\Database\Eloquent\Model;

class Topicality extends Model
{
    protected $fillable = ['title', 'content', 'user_id'];

    protected $casts = [
        'topicalities_id' => 'array'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
