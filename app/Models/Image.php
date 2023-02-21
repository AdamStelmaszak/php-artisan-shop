<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsTo(Product::class);
    }
    
    protected $fillable = [
        'path',
        'sq_path',
        'product_id'
    ];
}
