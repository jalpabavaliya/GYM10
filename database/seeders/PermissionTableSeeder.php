<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'food-list',
            'food-create',
            'food-edit',
            'food-delete',
            'exercise-list',
            'exercise-create',
            'exercise-edit',
            'exercise-delete',
            'workout-list',
            'workout-create',
            'workout-edit',
            'workout-delete',
            'meal-list',
            'meal-create',
            'meal-edit',
            'meal-delete',
            'meal-category-list',
            'meal-category-create',
            'meal-category-edit',
            'meal-category-delete',
            'assignWorkout-list',
            'assignWorkout-create',
            // 'assignWorkout-create',
            // 'assignWorkout-delete',
            'assignMeal-list',
            'assignMeal-create',
            // 'assignMeal-create',
            // 'assignMeal-delete',
            'postureimage-list',
            'postureimage-show',
            // 'postureimage-edit',
            // 'postureimage-delete',
            'subscription-list',
            'subscription-create',
            'subscription-edit',
            'subscription-delete',
         ];

         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
