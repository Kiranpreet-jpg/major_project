<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'teacher-list',
            'teacher-create',
            'teacher-edit',
            'teacher-delete',
            'course-list',
            'course-create',
            'course-edit',
            'course-delete',
            'batch-list',
            'batch-create',
            'batch-edit',
            'batch-delete',
            'subject-list',
            'subject-create',
            'subject-edit',
            'subject-delete',
            'student-list',
            'student-create',
            'student-edit',
            'student-delete',
            'assign-teacher-list',
            'assign-teacher-create',
            'assign-teacher-edit',
            'assign-teacher-delete',
            'notes-list',
            'notes-create',
            'notes-edit',
            'notes-delete',
            'assignment-list',
            'assignment-create',
            'assignment-edit',
            'assignment-delete',
            'teacher-student-list',
            'teacher-student-create',
            'teacher-student-edit',
            'teacher-student-delete',
            'view-feedback',
            'view-answer-assignment',
            'view-assignment-answer-detail',
            'mark-attendance',
            'view-attendance',

         ];

         foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
       }

    }
}
