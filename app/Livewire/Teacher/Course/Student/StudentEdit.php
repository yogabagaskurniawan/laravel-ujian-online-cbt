<?php

namespace App\Livewire\Teacher\Course\Student;

use Livewire\Component;
use App\Models\Test_result;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StudentEdit extends Component
{
    use LivewireAlert;
    public $testResult, $studentCount;
    public function mount($uid)
    {
        // Pastikan hanya teacher yang bisa mengakses ini
        if (auth()->user()->role != 'teacher') {
            abort(403, 'Unauthorized');
        }

        // Temukan kursus berdasarkan uid dan user_id
        $this->testResult = Test_result::where('uid', $uid)->firstOrFail();

        $this->studentCount = Test_result::where('course_id', $this->testResult->getCourse->id)
        ->whereHas('getUser', function ($query) {
            $query->where('role', 'student');
        })
        ->count();
        $this->studentCount = $this->studentCount ?: 0;
    }
    public function render()
    {
        return view('livewire.teacher.course.student.student-edit');
    }
}
