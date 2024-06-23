<?php

namespace App\Livewire\Teacher\Course\Manage;

use App\Models\Course;
use App\Models\Question;
use Livewire\Component;

class ManageList extends Component
{
    public $limitData, $course;
    public $search = '';
    public function mount($uid)
    {
        $this->limitData = 2;
        // Pastikan hanya teacher yang bisa mengakses ini
        if (auth()->user()->role != 'teacher') {
            abort(403, 'Unauthorized');
        }

        $this->course = Course::where('uid',$uid)->where('user_id',auth()->user()->id)->first();
    }
    public function render()
    {
        $questions = Question::where('course_id', $this->course->id)->search($this->search)->limit($this->limitData)->get();
        return view('livewire.teacher.course.manage.manage-list', compact('questions'));
    }
}
