<?php

namespace App\Livewire\Student\Course\TestCourse;

use App\Models\Answer_student;
use App\Models\Course;
use App\Models\Test_result;
use Livewire\Component;
use App\Models\Question;

class RapportDetail extends Component
{
    public $course;
    public $search = '';
    public $limitData, $testResult;
    public function mount($uid)
    {
        $this->limitData = 10;
        // Pastikan hanya teacher yang bisa mengakses ini
        if (auth()->user()->role != 'student') {
            abort(403, 'Unauthorized');
        }

        $this->course = Course::where('uid',$uid)->first();
        $this->testResult = Test_result::where('student_id', auth()->id())->where('course_id', $this->course->id)->first();
    }
    public function render()
    {
        // $questions = Question::where('course_id', $this->course->id)->search($this->search)->limit($this->limitData)->get();
        $answerStudents = Answer_student::where('student_id', auth()->user()->id)
            ->where('course_id', $this->course->id)
            ->with('getQuestion')
            ->limit($this->limitData)
            ->search($this->search)
            ->get();
    
        $totalQuestions = $answerStudents->pluck('getQuestion')->unique('id')->count();
        return view('livewire.student.course.test-course.rapport-detail',compact('answerStudents','totalQuestions'));
    }
    public function addLimitData()
    {
        $this->limitData += 10;
    }
}
