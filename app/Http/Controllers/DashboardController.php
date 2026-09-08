<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $tasks = [
            [
                'title' => 'Finish Laravel project',
                'status' => 'Completed',
            ],
            [
                'title' => 'Create dashboard',
                'status' => 'Pending',
            ],
            [
                'title' => 'Write project documentation',
                'status' => 'Pending',
            ],
            [
                'title' => 'Prepare presentation',
                'status' => 'Pending',
            ],
        ];

        $totalTasks = count($tasks);
        $completedTasks = count(
            array_filter($tasks, fn ($task) => $task['status'] === 'Completed')
        );
        $pendingTasks = $totalTasks - $completedTasks;

        return view('dashboard', compact(
            'tasks',
            'totalTasks',
            'completedTasks',
            'pendingTasks'
        ));
    }
}