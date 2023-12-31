<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'start_time',
        'end_time',
        'location',
        'description',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function participants(): BelongsToMany {
        return $this->belongsToMany(User::class);
    }

    public function announcements() : HasMany {
        return $this->hasMany(Announcement::class);
    }
}
