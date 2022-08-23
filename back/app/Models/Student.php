<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'email',
        'password',
        'gender',
        'class',
        'batch',
        'image',
    ];

    protected $hidden = [
        // 'created_at',
        'updated_at',
    ];

    public function studentKeaveRequest(){
        return $this->hasMany(StudentLeaveRquest::class, 'studentleaveRequest_id');
    }
}
