<?php

namespace App\Livewire\Student\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Dashboard extends Component
{
    #[Layout('components.layouts.student')]
    public function render()
    {
        return view('livewire.student.dashboard.dashboard');
    }
}
