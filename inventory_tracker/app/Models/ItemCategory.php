<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemCategory extends BaseModel
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
    ];

    public function products()
    {
        return $this->hasMany(ItemProducts::class);
    }
}
