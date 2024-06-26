<?php

namespace App\Livewire\Teacher\Course\Student;

use App\Models\Course;
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
        return view('livewire.teacher.course.student.student-list');
    }
}
