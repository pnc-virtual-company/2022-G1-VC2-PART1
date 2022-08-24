<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

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
        'updated_at',
    ];

// protected $dates = ['start_date', 'end_date', 'request_date','create_at'];

protected $casts = [
    'start_date'     => 'date:M d, Y',
    'end_date'     => 'date:M d, Y',
    'request_date'     => 'date:M d, Y',
];
    public function student(){
        return $this->belongsTo(Student::class);
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('M d, Y H:i: A');
    }
}
