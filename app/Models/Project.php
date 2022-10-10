<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UseUuid;

class Project extends Model
{
    use HasFactory, UseUuid;

    protected $table = 'projects';

    protected $fillable = [
        'uuid',
        'user_id',
        'title',
        'description'
    ];

    protected $hidden = [
        'id',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
