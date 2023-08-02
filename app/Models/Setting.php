<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'banner1',
        'banner2',
        'banner3',
        'banner4',
        'slogan',
        'description',
        'message',
        'aboutUrl',
        'siteUrl',
        'lastUpdate',
        'updatedUrl',
        'version',
    ];
}
