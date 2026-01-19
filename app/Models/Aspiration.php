<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aspiration extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'complaint_id',
        'status',
        'feedback',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }
}
