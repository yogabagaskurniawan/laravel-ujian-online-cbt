<?php

namespace App\Livewire\Student\Course\TestCourse;

use App\Models\Answer_student;
use App\Models\Course;
use App\Models\Detail_test_result;
use App\Models\Test_result;
use Livewire\Component;
use App\Models\Question;
use App\Models\Question_choice;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Ramsey\Uuid\Uuid;
class TestCourse extends Component
{
    use LivewireAlert;
    public $course, $correctAnswers;
    public $limitData;
    public $questions;
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
        $this->questions = Question::where('course_id', $this->course->id)->limit($this->limitData)->get();
        return view('livewire.student.course.test-course.test-course');
    }
    public function submitAnswers()
    {
        $validatedData = $this->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|integer|exists:question_choices,id',
        ]);

        if ($validatedData) {
            $this->correctAnswers = 0;
            // $totalQuestions = count($this->questions);
        
            foreach ($this->answers as $questionId => $choiceId) {
                // pengecekan jawaban benar atau salah
                $isCorrect = Question_choice::where('id', $choiceId)
                                            ->where('question_id', $questionId)
                                            ->where('is_correct', true)
                                            ->exists();
                if ($isCorrect) {
                    $this->correctAnswers++;
                }
            }
        
            // Tentukan status berdasarkan jumlah jawaban benar
            $status = $this->correctAnswers >= $this->course->totalQuestionCorrect ? 'succeed' : 'fail';
        
            // Ambil atau buat Test_result
            $testResult = Test_result::where('student_id', auth()->id())->where('course_id', $this->course->id)->first();
        
            // Buat Detail_test_result
            $detailTestResult = Detail_test_result::create([
                'test_result_id' => $testResult->id,
                'uid' => Uuid::uuid4()->toString(),
                'correctAnswers' => $this->correctAnswers,
                'status' => $status,
            ]);
        
            // Simpan jawaban siswa
            foreach ($this->answers as $questionId => $choiceId) {
                $isCorrect = Question_choice::where('id', $choiceId)
                                            ->where('question_id', $questionId)
                                            ->where('is_correct', true)
                                            ->exists();
        
                Answer_student::create([
                    'student_id' => auth()->id(),
                    'course_id' =>  $this->course->id,
                    'question_id' => $questionId,
                    // 'question_choice_id' => $choiceId,
                    'is_correct' => $isCorrect,
                    'detail_test_result_id' => $detailTestResult->id,
                ]);
            }
        
            return redirect()->to('/student/course/finished/'. $this->course->uid);
        }
        
    }
    public function addLimitData()
    {
        $this->limitData += 10;
    }
}
