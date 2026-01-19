<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complaint extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'student_id',
        'category_id',
        'image',
        'location',
        'description',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function aspiration(){
        return $this->hasOne(Aspiration::class);
    }
}
