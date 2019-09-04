<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Product;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $fillable = [
        'product_id', 'image_path', 'title', 'alt'
    ];

    public function product() {
        return $this->belongsTo('App\Model\Product');
    }
}
