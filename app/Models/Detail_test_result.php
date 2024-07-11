<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_test_result extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getTestResult()
    {
        return $this->belongsTo('App\Models\Test_result', 'test_result_id', 'id');
    }
}
