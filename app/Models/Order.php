<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'order_id';

    protected $fillable = [

        'order_id',
        'quantity',
        'address',
        'phone_no',
        'product_id',
        'user_id',
        'user_name',
        'final_price',
        'product_name',
    ];

    public function get_product()
    {
        return $this->hasMany(Product::class, 'product_id', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_name', 'name');
    }

    public function get_product_name()
    {
        return $this->hasMany(Product::class, 'product_name', 'name');
    }
}
