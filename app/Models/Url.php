<?php

namespace App\Models;

use App\Enum\MethodEnum;
use App\Enum\ServiceTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Url extends Model
{
    protected $guarded = [];

    protected $casts = [
        'headers' => 'json',
        'method' => MethodEnum::class,
        'service_type' => ServiceTypeEnum::class,
    ];

    public function certificate(): ?BelongsTo
    {
        return $this->belongsTo(Certificate::class);
    }

    public function tests(): ?HasMany
    {
        return $this->hasMany(Test::class);
    }

    public function useCertificates(): bool
    {
        return ! is_null($this->certificate_id);
    }
}
