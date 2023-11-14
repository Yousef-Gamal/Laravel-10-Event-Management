<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo,HasMany};

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','start_time','end_time','user_id'];

    public function user(): BelongsTo{
        return $this->belongsTo(\App\Models\User::class); // return type will be BelongsTo
    }
    public function attendees(): HasMany{
        return $this->hasMany(\App\Models\Attendee::class); // return type will be HasMany
    }
}
