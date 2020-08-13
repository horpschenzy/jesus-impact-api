<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;
class Feed extends Model
{
    use Likeable;
    protected $fillable = ['user_id','content','postType','status'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function files()
    {
        return $this->belongsToMany('App\Models\File');
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable')->whereNull('parent_id');
    }
}
