<?php

namespace App\Livewire\Teacher\Dashboard;

use App\Models\Category;
use App\Models\Course;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $courseCount = Course::where('user_id', auth()->user()->id)->count();
        $categoryCount = Category::count();
        return view('livewire.teacher.dashboard.dashboard', compact('courseCount', 'categoryCount'));
    }
}
