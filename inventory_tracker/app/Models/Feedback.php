<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends BaseModel
{
    protected $table = 'feedbacks';

    protected $fillable = [
        'user_id',
        'feedback_type',
        'subject',
        'message',
        'priority',
    ];

    public function images()
    {
        return $this->hasMany(FeedbackImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}