<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * CompleteTodo
 *
 * @property string $title
 * @property string $description
 */
class CompleteTodo extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];
}
