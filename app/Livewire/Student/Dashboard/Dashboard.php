<?php

namespace App\Livewire\Student\Dashboard;

use Livewire\Component;
use App\Models\Test_result;

class Dashboard extends Component
{
    public function render()
    {
        $courseCount = Test_result::where('student_id',auth()->user()->id)->count();
        return view('livewire.student.dashboard.dashboard', compact('courseCount'));
    }
}
