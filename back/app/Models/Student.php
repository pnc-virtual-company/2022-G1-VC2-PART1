<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'phone',
        'class',
        'batch',
        'gender',
        'image',
    ];

    protected $hidden = [
        'updated_at',
        'remember_token',
        'email_verified_at',
       
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function studentleavequest(){
        return $this->hasMany(StudentLeaveRquest::class, 'studentleaveRequest_id');
    }
    
    public function User()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
