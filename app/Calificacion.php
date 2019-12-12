<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Calificacion extends Model
{
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('post_id', '=', $this->getAttribute('post_id'))
            ->where('user_id', '=', $this->getAttribute('user_id'));
        return $query;
    }
}
