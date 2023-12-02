<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model {
    use HasFactory;

    protected $fillable = [
        'title',
        'datetime',
        'content',
        'photo_path',
    ];

    public $timestamps = false;
}
