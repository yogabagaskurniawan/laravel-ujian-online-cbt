<?php

namespace App\Livewire\Teacher\Course\Student;

use App\Models\User;
use App\Models\Course;
use Livewire\Component;
use App\Models\Test_result;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Ramsey\Uuid\Uuid;

class StudentAdd extends Component
{
    use LivewireAlert;
    public $course, $studentCount;
    public $email;
    public function mount($uid)
    {
        // Pastikan hanya teacher yang bisa mengakses ini
        if (auth()->user()->role != 'teacher') {
            abort(403, 'Unauthorized');
        }

        $this->course = Course::where('uid',$uid)->where('user_id',auth()->user()->id)->first();
        
        $this->studentCount = Test_result::where('course_id', $this->course->id)
        ->whereHas('getUser', function ($query) {
            $query->where('role', 'student');
        })
        ->count();
        $this->studentCount = $this->studentCount ?: 0;
    }
    public function addStudent()
    {
        $validatedData = $this->validate([
            'email' => 'required|email|exists:users,email',
        ]);
    
        if ($validatedData) {
            // Cari user berdasarkan email
            $user = User::where('email', $this->email)->first();
    
            if ($user) {
                // Periksa apakah role user adalah "student"
                if ($user->role === 'student') {
                    // Tambahkan murid ke dalam tabel Test_result
                    Test_result::create([
                        'course_id' => $this->course->id,
                        'student_id' => $user->id,
                        'uid' => Uuid::uuid4()->toString(),
                    ]);
    
                    $this->flash('success', 'Murid berhasil ditambahkan');
                } else {
                    $this->alert('error', 'Hanya pengguna dengan peran "student" yang dapat ditambahkan');
                    return back();
                }
            } else {
                // Jika user tidak ditemukan 
                $this->alert('error', 'Email tidak ditemukan di dalam sistem');
                return back();
            }
    
            return redirect()->to('/teacher/course/list-course/student/' . $this->course->uid);
        }
    }    
    public function render()
    {
        return view('livewire.teacher.course.student.student-add');
    }
}
