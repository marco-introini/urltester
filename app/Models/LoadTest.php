<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LoadTest extends Model
{
    protected $guarded = [];

    protected $casts = [
        'failure_responses' => 'array',
    ];

    public function url(): BelongsTo
    {
        return $this->belongsTo(Url::class);
    }

    public function executions(): HasMany
    {
        return $this->hasMany(LoadTestExecution::class);
    }
}
