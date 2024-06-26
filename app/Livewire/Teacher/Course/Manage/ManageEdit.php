<?php

namespace App\Livewire\Teacher\Course\Manage;

use App\Models\Course;
use Livewire\Component;
use App\Models\Question;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Ramsey\Uuid\Uuid;

class ManageEdit extends Component
{
    use LivewireAlert;
    use LivewireAlert;
    public $question;
    public $questionForm;
    public $questionId;
    public $answers = [];
    public $correctAnswer;
    public $uid;

    public function mount($uid)
    {
        // Pastikan hanya teacher yang bisa mengakses ini
        if (auth()->user()->role != 'teacher') {
            abort(403, 'Unauthorized');
        }

        // Temukan kursus berdasarkan uid dan user_id
        $this->question = Question::where('uid', $uid)->firstOrFail();

        $this->questionForm = $this->question->ask;

        // Ambil pilihan dari pertanyaan dan isi data ke form
        foreach ($this->question->getQuestionChoice as $index => $choice) {
            $this->answers[$index + 1] = $choice->choice;
            if ($choice->is_correct) {
                $this->correctAnswer = $index + 1;
            }
        }
    }
    public function render()
    {
        return view('livewire.teacher.course.manage.manage-edit');
    }
    public function editQuestion()
    {
        $validatedData = $this->validate([
            'questionForm' => 'required',
            'answers.1' => 'required',
            'answers.2' => 'required',
            'answers.3' => 'required',
            'answers.4' => 'required',
            'correctAnswer' => 'required|in:1,2,3,4'
        ]);

        if ($validatedData) {
            // Temukan kursus berdasarkan uid dan user_id
            $this->question = Question::where('uid',  $this->uid)->firstOrFail();

            // update pertanyaan
            $this->question->update([
                'ask' => $this->questionForm,
                'uid' => Uuid::uuid4()->toString()
            ]);

            // Update jawaban
            foreach ($this->answers as $key => $answer) {
                $choice = $this->question->getQuestionChoice()->where('id', $this->question->getQuestionChoice[$key - 1]->id)->first();

                if ($choice) {
                    $choice->update([
                        'choice' => $answer,
                        'is_correct' => $key == $this->correctAnswer
                    ]);
                }
            }

            $this->flash('success', 'Soal berhasil diperbarui');
            return redirect()->to('/teacher/course/list-course/manage/' . $this->question->getCourse->uid);
        }
    }
}
