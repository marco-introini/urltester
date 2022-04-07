<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Url extends Model
{
    protected $guarded = [];

    protected $casts = [
      'headers' => 'json',
    ];

    public function certificate(): ?BelongsTo
    {
        return $this->belongsTo(Certificate::class);
    }

}