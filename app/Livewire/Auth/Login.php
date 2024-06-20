<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Login extends Component
{
    use LivewireAlert;
    #[Layout('components.layouts.auth')]
    public $email;
    public $password;
    public function loginCurrentUser()
    {
        $this->validate([
            'email' => 'required'
        ]);

        $credentials = array(
            'email' =>  $this->email,
            'password' =>  $this->password
        );
         //attempt to login
        if (auth()->attempt($credentials)) {
            session()->regenerate();
            $role = auth()->user()->role;

            if ($role == 'teacher') {
                return redirect('/teacher/dashboard');
            }

            if ($role == 'student') {
                return redirect('/student/dashboard');
            }
        }

        //if login fails
        $this->alert('error','Akun tidak ditemukan atau password salah');
        return back();
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
