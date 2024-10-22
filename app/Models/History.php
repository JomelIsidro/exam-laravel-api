<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    // Specify the table associated with the model (if not the plural of the model name)
    protected $table = 'histories';

    // Define the fillable properties
    protected $fillable = [
        'ip',
        'city',
        'region',
        'country',
        'postal',
        'timezone',
    ];
}
