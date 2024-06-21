<?php

namespace App\Livewire\Teacher\Category;

use App\Models\Category;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Ramsey\Uuid\Uuid;

class CategoryAdd extends Component
{
    use LivewireAlert;

    public $name;

    public function render()
    {
        return view('livewire.teacher.category.category-add');
    }

    public function addCategory()
    {
        $validatedData = $this->validate([
            'name' => 'required|unique:categories'
        ]);

        if ($validatedData) {
            Category::create([
                'name' => $this->name,
                'uid' => Uuid::uuid4()->toString(),
            ]);
        }

        $this->flash('success', 'Kategori berhasil ditambahkan');
        return redirect()->to('/teacher/category/list-category');
    }
}

