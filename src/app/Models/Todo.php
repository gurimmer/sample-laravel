<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Todoクラス
 *
 * @property string $title
 * @property string $description
 */
class Todo extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];
}
