<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Hash;
class UpdatePassword extends Component
{
    use LivewireAlert;
    public $passwordOld;
    public $passwordNew;
    public $user;
    public function mount()
    {
        $this->user = User::where('id', auth()->user()->id)->first();
    }
    public function render()
    {
        return view('livewire.profile.update-password');
    }
    public function updatePassword($userId)
    {
        $this->validate([
            'passwordOld' => 'required|string|min:8',
            'passwordNew' => 'required|string|min:8|different:passwordOld',
        ]);

        $user = User::find($userId);
        
        if ($user && Hash::check($this->passwordOld, $user->password)) {
            $user->password = Hash::make($this->passwordNew);
            $user->save();

            $this->alert('success', 'Password berhasil diperbarui.');
        } else {
            $this->alert('error', 'Password lama tidak sesuai.');
        }

        return back();
    }
}
