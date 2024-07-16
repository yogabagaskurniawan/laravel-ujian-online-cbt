<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test_result extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getUser()
    {
        return $this->belongsTo('App\Models\User', 'student_id', 'id');
    }
    public function getCourse()
    {
        return $this->belongsTo('App\Models\Course', 'course_id', 'id');
    }
    public function scopeSearch($query, $keyword)
    {
        // Pemetaan kata-kata yang mungkin diketik oleh pengguna ke nilai status sebenarnya
        $statusMapping = [
            'Gagal' => 'fail',
            'Lolos' => 'succeed',
            'Belum mengerjakan' => 'not_started'
        ];

        // Cek apakah keyword cocok dengan salah satu nilai di statusMapping
        // Cari berdasarkan kecocokan parsial
        $statusKeyword = null;
        foreach ($statusMapping as $key => $value) {
            if (stripos($key, strtolower($keyword)) !== false) {
                $statusKeyword = $value;
                break;
            }
        }

        return $query->where(function ($query) use ($keyword, $statusKeyword) {
            $query->whereHas('getUser', function ($q) use ($keyword) {
                $q->where('email', 'LIKE', '%' . $keyword . '%')
                    ->orWhereHas('getDetailUser', function ($q) use ($keyword) {
                        $q->where('name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('address', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('phone', 'LIKE', '%' . $keyword . '%');
                    });
            });

            // if ($statusKeyword) {
            //     $query->orWhere('status', 'LIKE', '%' . $statusKeyword . '%');
            // }

            // Tambahan untuk pencarian berdasarkan nama course
            $query->orWhereHas('getCourse', function ($q) use ($keyword) {
                $q->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhereHas('getCategory', function($q) use ($keyword) {
                        $q->where('name', 'like', '%' . $keyword . '%');
                    });
            });
        });
    }
}
