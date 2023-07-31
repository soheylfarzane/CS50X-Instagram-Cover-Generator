<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'active',
        'font_id',
        'text1',
        'text2',
        'text3',
        'text4',
        'text5',
        'text6',
        'longText',
        'maxText1',
        'maxText2',
        'maxText3',
        'maxText4',
        'maxText5',
        'maxText6',
        'maxLongText',
        'logo',
        'category_id',


    ];
}
