<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name','email','password','score','is_admin'];
    public function photo(): MorphOne
    {
        return $this->morphOne(Photo::class, 'photoable');
    }
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class,'learnings', 'user_id', 'course_id','id','id');
    }
    public function favoris(): BelongsToMany
    {
        return $this->belongsToMany(Course::class,'favoris', 'user_id', 'course_id','id','id');
    }
    public function quizzes(): BelongsToMany
    {
        return $this->belongsToMany(Quiz::class);
    }

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
}
