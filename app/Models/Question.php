<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function scopeSearch($query, $keyword)
    {
        return $query->where('ask', 'LIKE', '%' . $keyword . '%');
    }
    public function getCourse()
    {
        return $this->belongsTo('App\Models\Course', 'course_id', 'id');
    }
    public function getQuestionChoice()
    {
        return $this->hasMany(Question_choice::class);
    }
}
