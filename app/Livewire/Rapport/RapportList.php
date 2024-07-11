<?php

namespace App\Livewire\Rapport;

use Livewire\Component;
use App\Models\Course;
use App\Models\Test_result;
use App\Models\Detail_test_result;
class RapportList extends Component
{
    public $course, $totalQuestions, $studentId;
    public function mount($uid, $studentId = null)
    {
        // Pastikan hanya student atau teacher yang bisa mengakses ini
        if (auth()->user()->role != 'student' && auth()->user()->role != 'teacher') {
            abort(403, 'Unauthorized');
        }

        $this->course = Course::where('uid',$uid)->first();
        $this->totalQuestions =  $this->course->getQuestion->count();

        // Jika studentId tidak disediakan, gunakan ID pengguna yang sedang login
        $this->studentId = $studentId ?: auth()->id();
    }
    public function render()
    {
        $testResult = Test_result::where('student_id', $this->studentId)->where('course_id', $this->course->id)->first();
        $detailTestResults = Detail_test_result::where('test_result_id', $testResult->id)->get();
        return view('livewire.rapport.rapport-list', compact('detailTestResults', 'testResult'));
    }
}
