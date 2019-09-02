<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    protected $fillable = [
        'post_id',
        'user_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\Entities\Post', 'post_id', 'id');
    }

}
