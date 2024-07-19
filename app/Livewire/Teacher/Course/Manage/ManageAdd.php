<?php

namespace App\Livewire\Teacher\Course\Manage;

use Ramsey\Uuid\Uuid;
use App\Models\Course;
use Livewire\Component;
use App\Models\Question;
use App\Models\Test_result;
use App\Models\Answer_teacher;
use App\Models\Question_choice;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ManageAdd extends Component
{
    use LivewireAlert;
    public $course;
    public $question;
    public $answers = [];
    public $correctAnswer;
    public $studentCount;
    public function mount($uid)
    {
        // Pastikan hanya teacher yang bisa mengakses ini
        if (auth()->user()->role != 'teacher') {
            abort(403, 'Unauthorized');
        }

        $this->course = Course::where('uid',$uid)->where('user_id',auth()->user()->id)->first();
        $this->studentCount = Test_result::where('course_id', $this->course->id)->count();
    }
    public function render()
    {
        return view('livewire.teacher.course.manage.manage-add');
    }
    public function addQuestion()
    {
        $validatedData = $this->validate([
            'question' => 'required',
            'answers.1' => 'required',
            'answers.2' => 'required',
            'answers.3' => 'required',
            'answers.4' => 'required',
            'correctAnswer' => 'required|in:1,2,3,4'
        ]);

        if ($validatedData) {
            $question = Question::create([
                'course_id' => $this->course->id,
                'ask' => $this->question,
                'uid' => Uuid::uuid4()->toString(),
            ]);

            foreach ($this->answers as $key => $answer) {
                $question->getQuestionChoice()->create([
                    'choice' => $answer,
                    'question_id' => $question->id,
                    'is_correct' => $key == $this->correctAnswer
                ]);
            }
        }
        $this->flash('success', 'Soal berhasil ditambahkan');
        return redirect()->to('/teacher/course/list-course/manage/'. $this->course->uid);
    }
}
