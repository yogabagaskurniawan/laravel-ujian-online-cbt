<?php

namespace App\Livewire\Teacher\Course\Student;

use App\Models\Course;
use App\Models\Test_result;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StudentList extends Component
{
    use LivewireAlert;
    public $limitData, $course;
    public $search = '';
    public function mount($uid)
    {
        $this->limitData = 10;
        // Pastikan hanya teacher yang bisa mengakses ini
        if (auth()->user()->role != 'teacher') {
            abort(403, 'Unauthorized');
        }

        $this->course = Course::where('uid',$uid)->where('user_id',auth()->user()->id)->first();
    }
    public function render()
{
    // Ambil test results dan gabungkan dengan tabel users untuk mendapatkan detail student
    $testResults = Test_result::where('course_id', $this->course->id)
        ->whereHas('getUser', function ($query) {
            $query->where('role', 'student');
        })
        ->search($this->search)
        ->limit($this->limitData)
        ->get();

    $studentCount = $testResults->count();
    return view('livewire.teacher.course.student.student-list', compact('testResults', 'studentCount'));
}
    public function addLimitData()
    {
        $this->limitData += 10;
    }
}
