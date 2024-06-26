<?php

namespace App\Livewire\Teacher\Course;

use App\Models\Category;
use App\Models\Course;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Ramsey\Uuid\Uuid;

class CourseEdit extends Component
{
    use LivewireAlert;
    public $name, $category, $uid, $course;
    public function mount($uid)
    {
        // Pastikan hanya teacher yang bisa mengakses ini
        if (auth()->user()->role != 'teacher') {
            abort(403, 'Unauthorized');
        }

        $this->course = Course::where('uid',$uid)->where('user_id', auth()->user()->id)->first();
        $this->name = $this->course->name;
        $this->category = $this->course->category_id;
    }
    public function editCourse()
    {
        $validatedData = $this->validate([
            'name' => 'required|unique:courses,name,' . $this->course->id,
            'category' => 'required|exists:categories,id',
        ]);

        if ($validatedData) {
            $course = Course::where('uid', $this->uid)->first();
            if (!$course) {
                // Handle jika Kelas tidak ditemukan
                $this->flash('error', 'Kelas tidak ditemukan');
                return;
            }

            // Update data Kelas
            $course->name = $this->name;
            $course->category_id = $this->category;
            $course->uid = Uuid::uuid4()->toString(); 

            // Simpan
            $course->save();

            $this->flash('success', 'Kelas berhasil diperbarui');
            return redirect()->to('teacher/course/list-course');
        }
    }
    public function render()
    {
        if ($this->course) {
            $categories = Category::get();    
            return view('livewire.teacher.course.course-edit', compact('categories'));
        }else{
            abort(404);
        }
    }
}
