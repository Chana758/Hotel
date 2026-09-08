<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // Define the table name (in case the table name differs from the default 'notifications')
    protected $table = 'notifications';

    // Allow mass assignment for these columns
    protected $fillable = [
        'type',
        'greeting',
        'body',
        'actiontext',
        'actionurl',
        'endline',
        'customer_email'
    ];
}