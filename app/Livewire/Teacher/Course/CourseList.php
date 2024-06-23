<?php

namespace App\Livewire\Teacher\Course;

use App\Models\Course;
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
        $courses = Course::where('user_id',auth()->user()->id)->latest()->search($this->search)->paginate(10);
        return view('livewire.teacher.course.course-list', compact('courses'));
    }
}
