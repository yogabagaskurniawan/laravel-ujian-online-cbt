<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class PersonalData extends Component
{
    use LivewireAlert;
    public $name;
    public $email;
    public $address;
    public $phone;
    public $user;
    public function mount()
    {
        $this->user = User::where('id', auth()->user()->id)->first();

        if ($this->user) {
            $this->name = $this->user->getDetailUser->name;
            $this->email = $this->user->email;
            $this->address = $this->user->getDetailUser->address;
            $this->phone = $this->user->getDetailUser->phone;
        }
    }
    public function render()
    {
        return view('livewire.profile.personal-data');
    }
    public function updateProfile($userId)
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $userId,
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $user = User::where('id', auth()->user()->id)->first();
        
        if ($user) {
            $user->email = $this->email;
            $user->save();

            $user->getDetailUser->update([
                'name' => $this->name,
                'address' => $this->address,
                'phone' => $this->phone,
            ]);

            $this->alert('success', 'Profil berhasil diperbarui.');
        } else {
            $this->alert('error', 'Pengguna tidak ditemukan.');
        }

        return back();
    }
}
