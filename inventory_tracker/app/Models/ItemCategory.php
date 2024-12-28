<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function products()
    {
        return $this->hasMany(ItemProducts::class);
    }
}
