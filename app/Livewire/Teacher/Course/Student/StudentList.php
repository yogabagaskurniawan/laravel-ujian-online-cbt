<?php

namespace App\Livewire\Teacher\Course\Student;

use App\Models\Course;
use Livewire\Component;
use App\Models\Test_result;
use App\Models\Answer_student;
use App\Models\Detail_test_result;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StudentList extends Component
{
    use LivewireAlert;
    public $limitData, $course;
    public $search = '';
    public function mount($uid)
    {
        $this->limitData = 10;
        // Pastikan hanya teacher yang bisa mengakses ini
        if (auth()->user()->role != 'teacher') {
            abort(403, 'Unauthorized');
        }

        $this->course = Course::where('uid',$uid)->where('user_id',auth()->user()->id)->first();
    }
    public function render()
    {
        // Ambil test results dan gabungkan dengan tabel users untuk mendapatkan detail student
        $testResults = Test_result::where('course_id', $this->course->id)
            ->whereHas('getUser', function ($query) {
                $query->where('role', 'student');
            })
            ->search($this->search)
            ->limit($this->limitData)
            ->get();

        $studentCount = $testResults->count();
        return view('livewire.teacher.course.student.student-list', compact('testResults', 'studentCount'));
    }
    public function deleteStudent($testResultId)
    {
        // Cari Test Result berdasarkan id
        $testResult = Test_result::where('id', $testResultId)->first();

        if ($testResult) {
            // Hapus entri dari tabel detail_test_results yang terkait dengan Test Result ini
            $detailTestResults = Detail_test_result::where('test_result_id', $testResultId)->get();
            foreach ($detailTestResults as $detailTestResult) {
                // Hapus entri dari tabel answer_students yang terkait dengan detail_test_result ini
                $answerStudents = Answer_student::where('detail_test_result_id', $detailTestResult->id)->where('course_id', $this->course->id)->get();
                foreach ($answerStudents as $answerStudent) {
                    $answerStudent->delete();
                }

                // Hapus detail_test_result
                $detailTestResult->delete();
            }

            // Hapus Test Result dari tabel test_results
            $testResult->delete();

            $this->alert('success', 'Data siswa berhasil dihapus.');
        } else {
            $this->alert('error', 'Data siswa tidak ditemukan.');
        }

        return back();
    }
    public function addLimitData()
    {
        $this->limitData += 10;
    }
}
