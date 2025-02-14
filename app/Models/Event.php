<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $guarded = ['id'];

    public function event_record(): HasMany
    {
        return $this->hasMany(EventRecord::class);
    }
}