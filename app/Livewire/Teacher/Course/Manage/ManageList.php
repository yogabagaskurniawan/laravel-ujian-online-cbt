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
        $this->studentCount = Test_result::where('course_id', $this->course->id)->count();
    }
    public function render()
    {
        $questions = Question::where('course_id', $this->course->id)->search($this->search)->limit($this->limitData)->get();
        return view('livewire.teacher.course.manage.manage-list', compact('questions'));
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
