<?php

namespace App\Livewire\Student\Course\TestCourse;

use App\Models\Answer_student;
use App\Models\Course;
use Livewire\Component;
use App\Models\Question;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class TestCourse extends Component
{
    use LivewireAlert;
    public $course;
    public $limitData;
    public $answers = [];
    #[Layout('components.layouts.question')]
    public function mount($uid)
    {
        $this->limitData = 10;
        // Pastikan hanya teacher yang bisa mengakses ini
        if (auth()->user()->role != 'student') {
            abort(403, 'Unauthorized');
        }

        $this->course = Course::where('uid',$uid)->first();
    }
    public function render()
    {
        $questions = Question::where('course_id', $this->course->id)->limit($this->limitData)->get();
        return view('livewire.student.course.test-course.test-course', compact('questions'));
    }
    public function submitAnswers()
    {
        $validatedData = $this->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|exists:question_choices,id',
        ]);

        if ($validatedData) {
            foreach ($this->answers as $questionId => $choiceId) {
                Answer_student::create([
                    'course_id' => $this->course->id,
                    'question_id' => $questionId,
                    'question_choice_id' => $choiceId,
                    'student_id' => auth()->user()->id,
                ]);
            }
        }
        // $this->flash('success', 'Jawaban berhasil disimpan.');
        return redirect()->to('/student/course/finished/'. $this->course->uid);
    }
    public function addLimitData()
    {
        $this->limitData += 10;
    }
}
