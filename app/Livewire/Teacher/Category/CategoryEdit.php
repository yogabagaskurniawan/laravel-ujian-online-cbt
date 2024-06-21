<?php

namespace App\Livewire\Teacher\Category;

use App\Models\Category;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Ramsey\Uuid\Uuid;

class CategoryEdit extends Component
{
    use LivewireAlert;
    public $name, $category, $uid;
    public function mount($uid)
    {
        // Pastikan hanya teacher yang bisa mengakses ini
        if (auth()->user()->role != 'teacher') {
            abort(403, 'Unauthorized');
        }

        $this->category = Category::where('uid',$uid)->first();

        // Set nilai properti berdasarkan data rumah yang ditemukan
        if ($this->category) {
            $this->name = $this->category->name;
            $this->uid = $this->category->uid;
        }
    }
    public function editCategory()
    {
        $validatedData = $this->validate([
            'name' => 'required|unique:categories,name,' . $this->category->id,
        ]);

        if ($validatedData) {
            $category = Category::where('uid', $this->uid)->first();
            if (!$category) {
                // Handle jika kategori tidak ditemukan
                $this->flash('error', 'Kategori tidak ditemukan');
                return;
            }

            // Update data kategori
            $category->name = $this->name;
            $category->uid = Uuid::uuid4()->toString(); 

            // Simpan
            $category->save();

            $this->flash('success', 'Kategori berhasil diperbarui');
            return redirect()->to('teacher/category/list-category');
        }
    }
    public function render()
    {
        if ($this->category) {
            return view('livewire.teacher.category.category-edit');
        }else{
            abort(404);
        }
    }
}
