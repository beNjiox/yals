<?php

class Comment extends Eloquent {
    protected $fillable = [ 'type', 'text', 'user_id' ];

    public function user() { return $this->belongsTo('User'); }
}
