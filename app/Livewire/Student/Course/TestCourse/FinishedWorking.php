<?php

namespace App\Livewire\Student\Course\TestCourse;

use Livewire\Attributes\Layout;
use App\Models\Course;
use Livewire\Component;

class FinishedWorking extends Component
{
    public $course;
    #[Layout('components.layouts.question')]
    public function mount($uid)
    {
        // Pastikan hanya teacher yang bisa mengakses ini
        if (auth()->user()->role != 'student') {
            abort(403, 'Unauthorized');
        }

        $this->course = Course::where('uid',$uid)->first();
    }
    public function render()
    {
        return view('livewire.student.course.test-course.finished-working');
    }
}
