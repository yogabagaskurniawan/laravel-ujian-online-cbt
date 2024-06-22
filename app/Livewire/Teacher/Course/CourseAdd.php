<?php

namespace App\Livewire\Teacher\Course;

use App\Models\Category;
use App\Models\Course;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Ramsey\Uuid\Uuid;

class CourseAdd extends Component
{
    use LivewireAlert;
    public $name, $category;
    public function render()
    {
        $categories = Category::latest()->get();
        return view('livewire.teacher.course.course-add', compact('categories'));
    }
    public function addCourse()
    {
        $validatedData = $this->validate([
            'name' => 'required|unique:courses',
            'category' => 'required|exists:categories,id',
        ]);

        if ($validatedData) {

            Course::create([
                'name' => $this->name,
                'category_id' => $this->category,
                'uid' => Uuid::uuid4()->toString(),
                'user_id' => auth()->user()->id
            ]);
        }
        $this->flash('success', 'Kelas berhasil ditambahkan');
        return redirect()->to('/teacher/course/list-course');
    }
}
