<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Url extends Model
{
    protected $guarded = [];

    public function certificate(): HasOne
    {
        return $this->hasOne(Certificate::class);
    }

}