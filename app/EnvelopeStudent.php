<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnvelopeStudent extends Model
{
    protected $fillable = ['title', 'description', 'teacher_id', 'student_id', 'status'];

    public function users()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'student_id');
    }
}
