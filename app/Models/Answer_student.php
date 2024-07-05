<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer_student extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getQuestion()
    {
        return $this->belongsTo('App\Models\Question', 'question_id', 'id');
    }
    public function scopeSearch($query, $keyword)
    {
        $statusMapping = [
            'Salah' => 0,
            'Benar' => 1,
        ];

        $statusKeyword = null;
        foreach ($statusMapping as $key => $value) {
            if (stripos($key, strtolower($keyword)) !== false) {
                $statusKeyword = $value;
                break;
            }
        }

        $query->whereHas('getQuestion', function($q) use ($keyword) {
            $q->where('ask', 'LIKE', '%' . $keyword . '%');
        });

        if (!is_null($statusKeyword)) {
            $query->orWhere('is_correct', $statusKeyword);
        }

        return $query;
    }
}
