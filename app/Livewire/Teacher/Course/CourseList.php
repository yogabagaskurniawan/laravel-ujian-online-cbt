<?php

namespace App\Livewire\Teacher\Course;

use App\Models\Course;
use Livewire\Component;
use App\Models\Question;
use App\Models\Test_result;
use Livewire\WithPagination;
use App\Models\Answer_student;
use App\Models\Detail_test_result;
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

            $testResult = Test_result::where('course_id', $course->id)->first();

            if ($testResult) {
                // Hapus entri dari tabel detail_test_results yang terkait dengan Test Result ini
                $detailTestResults = Detail_test_result::where('test_result_id', $testResult->id)->get();
                foreach ($detailTestResults as $detailTestResult) {
                    // Hapus entri dari tabel answer_students yang terkait dengan detail_test_result ini
                    $answerStudents = Answer_student::where('detail_test_result_id', $detailTestResult->id)->where('course_id', $course->id)->get();
                    foreach ($answerStudents as $answerStudent) {
                        $answerStudent->delete();
                    }
    
                    // Hapus detail_test_result
                    $detailTestResult->delete();
                }
    
                // Hapus Test Result dari tabel test_results
                $testResult->delete();
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
