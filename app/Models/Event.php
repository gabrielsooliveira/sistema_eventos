<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'description', 'city', 'private', 'image', 'items', 'date', 'meta_participants','user_id'
    ];

    use HasFactory;
}
