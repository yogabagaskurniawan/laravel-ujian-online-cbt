<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getDetailUser()
    {
        return $this->hasOne(Detail_user::class, 'user_id');
    }
    public function getCourse()
    {
        return $this->hasMany(Course::class, 'user_id');
    }
    public function getTestResult()
    {
        return $this->hasMany(Test_result::class, 'student_id');
    }
    public function scopeSearch($query, $keyword)
    {
        return $query->where('email', 'LIKE', '%' . $keyword . '%')
            ->orWhereHas('getDetailUser', function ($q) use ($keyword) {
                $q->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('address', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('phone', 'LIKE', '%' . $keyword . '%');
            });
    }
    // public function scopeSearch($query, $keyword)
    // {
    //     return $query->where(function ($query) use ($keyword) {
    //         $query->whereHas('getUser', function ($q) use ($keyword) {
    //             $q->where('email', 'LIKE', '%' . $keyword . '%')
    //                 ->orWhereHas('getDetailUser', function ($q) use ($keyword) {
    //                     $q->where('name', 'LIKE', '%' . $keyword . '%');
    //                 });
    //         });
    //     });
    // }
}
