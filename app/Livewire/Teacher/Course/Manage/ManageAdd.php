<?php

namespace App\Livewire\Teacher\Course\Manage;

use App\Models\Answer_teacher;
use App\Models\Course;
use Livewire\Component;
use App\Models\Question;
use App\Models\Question_choice;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class ManageAdd extends Component
{
    use LivewireAlert;
    public $course;
    public $question;
    public $answers = [];
    public $correctAnswer;
    public function mount($uid)
    {
        // Pastikan hanya teacher yang bisa mengakses ini
        if (auth()->user()->role != 'teacher') {
            abort(403, 'Unauthorized');
        }

        $this->course = Course::where('uid',$uid)->where('user_id',auth()->user()->id)->first();
    }
    public function render()
    {
        return view('livewire.teacher.course.manage.manage-add');
    }
    public function addQuestion()
    {
        $validatedData = $this->validate([
            'question' => 'required|string',
            'answers.1' => 'required|string',
            'answers.2' => 'required|string',
            'answers.3' => 'required|string',
            'answers.4' => 'required|string',
            'correctAnswer' => 'required|in:1,2,3,4'
        ]);

        if ($validatedData) {
            $question = Question::create([
                'course_id' => $this->course->id,
                'ask' => $this->question
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
