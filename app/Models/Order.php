<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    use HasFactory;

    protected $fillable = [
        'selectedDate',
        'address',
        'name',
        'phone',
        'email',
        'wishes',
        'isCompleted',
        'cart'
    ];
}
