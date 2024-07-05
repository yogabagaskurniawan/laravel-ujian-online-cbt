<?php

namespace App\Livewire\Teacher\Course\Manage;

use App\Models\Course;
use Livewire\Component;
use App\Models\Question;
use App\Models\Test_result;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ManageList extends Component
{
    use LivewireAlert;
    public $limitData, $course;
    public $totalQuestion;
    public $totalQuestionCorrect;
    public $search = '';
    public $studentCount;
    public function mount($uid)
    {
        $this->limitData = 10;
        // Pastikan hanya teacher yang bisa mengakses ini
        if (auth()->user()->role != 'teacher') {
            abort(403, 'Unauthorized');
        }

        $this->course = Course::where('uid',$uid)->where('user_id',auth()->user()->id)->first();
        if ($this->course) {
            $this->totalQuestion = $this->course->totalQuestion;
            $this->totalQuestionCorrect = $this->course->totalQuestionCorrect;
        }
        $this->studentCount = Test_result::where('course_id', $this->course->id)->count();
    }
    public function render()
    {
        $questions = Question::where('course_id', $this->course->id)->search($this->search)->limit($this->limitData)->get();
        $questionCount = $questions->count();
        return view('livewire.teacher.course.manage.manage-list', compact('questions', 'questionCount'));
    }
    public function updateSettingQuestion()
    {
        $validatedData = $this->validate([
            'totalQuestion' => 'required|integer|min:1',
            'totalQuestionCorrect' => 'required|integer|min:1',
        ]);

        if ($this->totalQuestion <= $this->totalQuestionCorrect) {
            $this->alert('error', 'Jumlah soal harus lebih besar dari jumlah soal yang harus benar');
            return back();
        }
        
        if ($validatedData) {
            if ($this->course) {
                // Update existing setting
                $this->course->update([
                    'totalQuestion' => $this->totalQuestion,
                    'totalQuestionCorrect' => $this->totalQuestionCorrect,
                ]);
            }
        }
        $this->alert('success', 'Pengaturan soal berhasil disimpan');
        return back();
    }
    public function deleteQuestion($id)
    {
        // Cari kategori berdasarkan id
        $question = Question::where('id', $id)->first();

        if ($question) {
            // Hapus entri dari tabel question_choices yang terkait dengan pertanyaan ini
            $question->getQuestionChoice()->delete();
            // Hapus entri dari tabel question
            $question->delete();

            $this->alert('success', 'Berhasil menghapus pertanyaan ini');
        } else {
            $this->alert('error', 'pertanyaan tidak ditemukan');
        }

        return back();
    }
    public function addLimitData()
    {
        $this->limitData += 10;
    }
}
