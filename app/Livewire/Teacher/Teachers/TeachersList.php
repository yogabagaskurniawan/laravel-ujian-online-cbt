<?php

namespace App\Livewire\Teacher\Teachers;

use App\Models\Detail_user;
use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class TeachersList extends Component
{
    use LivewireAlert;
    use WithPagination;
    public $search = '';
    public $limitData;
    public function mount()
    {
        $this->limitData = 10;
        // Pastikan hanya teacher yang bisa mengakses ini
        if (auth()->user()->role != 'teacher') {
            abort(403, 'Unauthorized');
        }
    }
    public function render()
    {
        $teachers = User::where('role', 'teacher')->latest()->search($this->search)->limit($this->limitData)->get();
        return view('livewire.teacher.teachers.teachers-list', compact('teachers'));
    }
    public function addLimitData()
    {
        $this->limitData += 10;
    }
    public function deleteTeacher($id)
    {
        // Cari guru berdasarkan id
        $teacher = User::where('id', $id)->first();

        if ($teacher) {
            $detailTeacher = Detail_user::where('user_id', $teacher->id)->first();
            $detailTeacher->delete();

            // Hapus entri dari tabel category
            $teacher->delete();

            $this->alert('success', 'Berhasil menghapus Guru ini');
        } else {
            $this->alert('error', 'Guru tidak ditemukan');
        }

        return back();
    }
}
