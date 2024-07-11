<?php

namespace App\Livewire\Rapport;

use App\Models\Answer_student;
use App\Models\Course;
use App\Models\Detail_test_result;
use App\Models\Test_result;
use Livewire\Component;
use App\Models\Question;

class RapportDetail extends Component
{
    public $detailTestResult;
    public $search = '';
    public $limitData;
    public $studentId;
    public function mount($uid, $studentId = null)
    {
        $this->limitData = 10;

        // Pastikan hanya student atau teacher yang bisa mengakses ini
        if (auth()->user()->role != 'student' && auth()->user()->role != 'teacher') {
            abort(403, 'Unauthorized');
        }

        $this->detailTestResult = Detail_test_result::where('uid',$uid)->first();

        // Jika studentId tidak disediakan, gunakan ID pengguna yang sedang login
        $this->studentId = $studentId ?: auth()->id();
    }
    public function render()
    {
        // $questions = Question::where('course_id', $this->course->id)->search($this->search)->limit($this->limitData)->get();
        $answerStudents = Answer_student::where('student_id',  $this->studentId)
            ->where('course_id', $this->detailTestResult->getTestResult->getCourse->id)
            ->where('detail_test_result_id', $this->detailTestResult->id)
            ->with('getQuestion')
            ->limit($this->limitData)
            ->search($this->search)
            ->get();
    
        $totalQuestions = $answerStudents->pluck('getQuestion')->unique('id')->count();
        return view('livewire.rapport.rapport-detail',compact('answerStudents','totalQuestions'));
    }
    public function addLimitData()
    {
        $this->limitData += 10;
    }
}
