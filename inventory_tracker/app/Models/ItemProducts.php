<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemProducts extends BaseModel
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'category_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function orderItems()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
