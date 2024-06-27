<?php

namespace App\Livewire\Student\Course\TestCourse;

use App\Models\Course;
use Livewire\Component;
use App\Models\Question;
use Livewire\Attributes\Layout;
class TestCourse extends Component
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
        $questions = Question::where('course_id', $this->course->id)->get();
        return view('livewire.student.course.test-course.test-course', compact('questions'));
    }
}
