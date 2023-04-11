<?php

namespace App\Models;

use App\Enum\ExecutionStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoadTestExecution extends Model
{

    protected $casts = [
        'executed_at' => 'datetime',
        'status' => ExecutionStatusEnum::class,
    ];

    public function test(): BelongsTo
    {
        return $this->belongsTo(LoadTest::class);
    }

}
