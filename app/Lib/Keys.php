<?php

namespace App\Lib;

use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class Keys
{
    public function keys()
    {
        $keys =
            [
                'دکتر کاویانی' => 'coverKaviyani',
                'کاور کلاته مدل اول' => 'coverKalateModel1',
            ];

        return $keys;
    }
    }
