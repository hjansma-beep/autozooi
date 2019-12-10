<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    public function getPrijsAttribute($value)
    {
        return number_format(($value /100), 2, '.', ' ');
    }
}
