<?php

namespace App\Livewire\Teacher\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class CategoryList extends Component
{
    use LivewireAlert;
    use WithPagination;
    public $search = '';
    public function render()
    {
        $categories = Category::latest()->search($this->search)->paginate(10);
        return view('livewire.teacher.category.category-list', compact('categories'));
    }
    public function deleteCategory($id)
    {
        // Cari kategori berdasarkan id
        $category = Category::where('id', $id)->first();

        if ($category) {
            // Hapus entri dari tabel category
            $category->delete();

            $this->alert('success', 'Berhasil menghapus kategori ini');
        } else {
            $this->alert('error', 'Kategori tidak ditemukan');
        }

        return back();
    }
}
