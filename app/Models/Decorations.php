<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decorations extends Model
{
    use HasFactory;

    protected $appends = [
        'nom_photo',
    ];
}
