<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Detail_user;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user_teacher = new User;
        $user_teacher->email = 'teacher@example.com';
        $user_teacher->password = Hash::make('admin123');
        $user_teacher->role = 'teacher';
        $user_teacher->save();

        $teacher = new Detail_user();
        $teacher->user_id = $user_teacher->id;
        $teacher->name = 'Anto Wardana';
        $teacher->phone = '0123456';
        $teacher->address = 'Pekalongan';
        $teacher->save();
    }
}
