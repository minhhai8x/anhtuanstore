<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name', 'parent_id'
    ];

    public function products() {
        return $this->hasMany('App\Model\Product');
    }
}
