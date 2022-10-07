<?php

namespace App\Traits;
use Illuminate\Support\Str;

trait UseUuid
{
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = (string) Str::orderedUuid();
        });
    }
}
