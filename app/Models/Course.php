<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getCategory()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('name', 'like', '%' . $search . '%')
                        ->orWhereHas('getCategory', function($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        });
        }
        return $query;
    }
}
