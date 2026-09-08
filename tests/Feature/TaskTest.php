<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_can_be_accessed(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_task_can_be_created(): void
    {
        $response = $this->post('/tasks', [
            'title' => 'Belajar Laravel',
        ]);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('tasks', [
            'title' => 'Belajar Laravel',
            'status' => 'Pending',
        ]);
    }

    public function test_task_status_can_be_updated(): void
    {
        $task = Task::create([
            'title' => 'Task Test',
            'status' => 'Pending',
        ]);

        $response = $this->patch(
            route('tasks.update-status', $task)
        );

        $response->assertRedirect('/');

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'Completed',
        ]);
    }
}
