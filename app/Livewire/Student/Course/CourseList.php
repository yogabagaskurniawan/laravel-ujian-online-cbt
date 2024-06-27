<?php

namespace App\Livewire\Student\Course;

use App\Models\Course;
use App\Models\Test_result;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class CourseList extends Component
{
    use LivewireAlert;
    use WithPagination;
    public $search = '';
    public function render()
    {
        $myCourses = Test_result::where('student_id',auth()->user()->id)->latest()->search($this->search)->paginate(10);
        return view('livewire.student.course.course-list', compact('myCourses'));
    }
}
