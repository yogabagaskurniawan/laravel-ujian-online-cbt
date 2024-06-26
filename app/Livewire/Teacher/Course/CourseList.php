<?php

namespace App\Livewire\Teacher\Course;

use App\Models\Course;
use Livewire\Component;
use App\Models\Question;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CourseList extends Component
{
    use LivewireAlert;
    use WithPagination;
    public $search = '';
    public function render()
    {
        $courses = Course::where('user_id',auth()->user()->id)->latest()->search($this->search)->paginate(10);
        return view('livewire.teacher.course.course-list', compact('courses'));
    }
    public function deleteCourse($id)
    {
        // Cari Kelas berdasarkan id
        $course = Course::where('id', $id)->first();
    
        if ($course) {
            // Ambil pertanyaan yang terkait dengan Kelas ini
            $questions = Question::where('course_id', $course->id)->get();
    
            // Hapus entri dari tabel questions yang terkait dengan Kelas ini
            foreach ($questions as $question) {
                $question->getQuestionChoice()->delete(); // Hapus entri dari tabel question_choices
                $question->delete(); // Hapus pertanyaan dari tabel questions
            }
    
            // Hapus Kelas dari tabel courses
            $course->delete();
    
            $this->alert('success', 'Berhasil menghapus Kelas beserta pertanyaan dan pilihan jawaban terkait');
        } else {
            $this->alert('error', 'Kelas tidak ditemukan');
        }
    
        return back();
    }    
}
