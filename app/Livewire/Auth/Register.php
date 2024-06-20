<?php

namespace App\Livewire\Auth;

use App\Models\Detail_user;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    use LivewireAlert;

    #[Layout('components.layouts.auth')]
    public $name;
    public $phone;
    public $address;
    public $email;
    public $password;
    public $confirm_password;

    public function registerCurrentUser()
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
        ]);
        
        Detail_user::create([
            'user_id' => $user->id, 
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
        ]);

        auth()->login($user);

        session()->regenerate();

        return redirect('/student/dashboard');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
