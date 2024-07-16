<?php

namespace App\Livewire\Teacher\Teachers;

use App\Models\User;
use Livewire\Component;
use App\Models\Detail_user;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class TeachersAdd extends Component
{
    use LivewireAlert;
    public $name;
    public $phone;
    public $address;
    public $email;
    public $password;
    public $confirm_password;
    public function render()
    {
        return view('livewire.teacher.teachers.teachers-add');
    }
    public function addTeacher()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|same:confirm_password',
            'confirm_password' => 'required|min:6'
        ]);

        $user = User::create([
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'teacher' 
        ]);
        
        Detail_user::create([
            'user_id' => $user->id, 
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
        ]);

        $this->flash('success', 'Data guru berhasil ditambahkan');
        return redirect()->to('/teacher/teachers/list-teachers');
    }
}
