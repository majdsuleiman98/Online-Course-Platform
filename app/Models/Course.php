<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;
    protected $fillable=["title","description","slug","price","track_id"];
    public function photo(): MorphOne
    {
        return $this->morphOne(Photo::class, 'photoable');
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'learnings', 'course_id', 'user_id','id','id');
    }
    public function usersfavori(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favoris', 'course_id', 'user_id','id','id');
    }
    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }
    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }
}
