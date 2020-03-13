<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    protected $table = "to_do_list";

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
