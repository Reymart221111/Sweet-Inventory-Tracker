<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends BaseModel
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function orderItems()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function products()
    {
        return $this->belongsToMany(ItemProducts::class, 'order_product')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
}
