<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'category_id', 'name'
    ];

    public function categories() {
        return $this->belongsTo('Category');
    }
}
