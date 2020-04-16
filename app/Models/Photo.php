<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'name',
        'storage_path',
        'storage_location',
        'url',
        'external_id',
        'dimensions',
        'metadata'
    ];

    protected $casts = ['dimensions' => Json::class, 'metadata' => Json::class];
}
