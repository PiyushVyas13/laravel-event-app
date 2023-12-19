<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content'
    ];

    public function event() : BelongsTo {
        return $this->belongsTo(Event::class);
    }

    public function creator() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}
