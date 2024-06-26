<?php

namespace App\Livewire\Teacher\Course\Student;

use App\Models\User;
use App\Models\Course;
use Livewire\Component;
use App\Models\Test_result;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StudentAdd extends Component
{
    use LivewireAlert;
    public $course;
    public $email;
    public function mount($uid)
    {
        // Pastikan hanya teacher yang bisa mengakses ini
        if (auth()->user()->role != 'teacher') {
            abort(403, 'Unauthorized');
        }

        $this->course = Course::where('uid',$uid)->where('user_id',auth()->user()->id)->first();
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
                // Tambahkan murid ke dalam tabel Test_result
                Test_result::create([
                    'course_id' => $this->course->id,
                    'user_id' => $user->id
                ]);
    
                $this->flash('success', 'Murid berhasil ditambahkan');
            } else {
                // Jika user tidak ditemukan (seharusnya tidak terjadi karena sudah divalidasi di atas)
                $this->flash('error', 'Email tidak ditemukan di dalam sistem');
            }
    
            return redirect()->to('/teacher/course/list-course/student/' . $this->course->uid);
        }
    }
    
    public function render()
    {
        return view('livewire.teacher.course.student.student-add');
    }
}
