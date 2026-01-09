<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(task_category::class, 'category_id');
    }
}
