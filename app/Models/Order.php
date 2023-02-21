<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function soldProduct()
    {
        return $this->hasMany(SoldProduct::class);
    }

    protected $fillable = ['user_id', 'price', 'is_paid'];
}
