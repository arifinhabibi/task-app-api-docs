<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $users = [
            [
                'fullname' => 'John Doe',
                'email' => 'john@gmail.com',
                'username' => 'john_doe',
                'password' => bcrypt('12345'),
            ],
            [
                'fullname' => 'Test',
                'email' => 'test@gmail.com',
                'username' => 'test',
                'password' => bcrypt('12345'),
            ]
        ];
        
        foreach ($users as $user) {
            # code...
            User::create($user);
        }

        Task::create([
            'title' => 'Task Title',
            'content' => 'Task Description',
        ]);
    }
}
