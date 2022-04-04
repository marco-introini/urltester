<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Certificate extends Model
{
    protected $guarded = [];

    public function urls() : BelongsToMany
    {
        return $this->belongsToMany(Url::class);
    }


}