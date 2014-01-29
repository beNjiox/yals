<?php

class Company extends Eloquent {
    protected $fillable = [ 'name', 'website_url', 'description', 'logo_path', 'email' ];

    public function users() { return $this->hasMany('User'); }
}