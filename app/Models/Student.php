<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'birthdate',
        'grade'
    ];
    public function classes()
    {
        return $this->belongsToMany(SchoolClass::class, 'class_student');
    }

}
