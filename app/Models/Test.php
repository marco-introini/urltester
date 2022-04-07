<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $guarded = [];

    public function tests(): ?BelongsTo
    {
        return $this->belongsTo(Url::class);
    }

}