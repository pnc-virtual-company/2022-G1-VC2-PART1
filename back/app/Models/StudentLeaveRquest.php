<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentLeaveRquest extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_date',
        'end_date',
        'reason',
        'leave_type',
        'duration',
        'status',
        'request_date',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // protected $dateFormat = 'm/d/Y';

protected $dates = ['start_date', 'end_date', 'request_date'];

protected $casts = [
    'start_date'     => 'date:m/d/y',
    'end_date'     => 'date:m/d/y',
    'request_date'     => 'date:m/d/y',
];
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
