<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class News extends Model
{
    protected $table = "news";

    public function category(){
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    public function comments(){
        return $this->hasMany('App\Comment', 'news_id', 'id');
    }

    public function users(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    protected static function boot()
    {
        parent::boot();

        // Order by name ASC
        static::addGlobalScope('news', function (Builder $builder) {
            $builder->orderBy('created_at', 'DESC');
        });
    }
}
