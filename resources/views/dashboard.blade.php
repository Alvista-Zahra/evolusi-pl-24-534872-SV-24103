<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Dashboard</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            color: #222;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .header h1 {
            font-size: 28px;
        }

        .add-button {
            background: #222;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 8px;
        }

        .welcome {
            margin-bottom: 25px;
        }

        .welcome h2 {
            font-size: 24px;
            margin-bottom: 8px;
        }

        .welcome p {
            color: #777;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 35px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.05);
        }

        .card h3 {
            font-size: 32px;
            margin-bottom: 5px;
        }

        .card p {
            color: #777;
        }

        .tasks {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.05);
        }

        .tasks h2 {
            margin-bottom: 20px;
        }

        .task {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 0;
            border-bottom: 1px solid #eee;
        }

        .task:last-child {
            border-bottom: none;
        }

        .task-title {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
        }

        .completed {
            background: #e7f7ed;
            color: #218838;
        }

        .pending {
            background: #fff3cd;
            color: #856404;
        }

        @media (max-width: 700px) {
            .stats {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Task Dashboard</h1>
        <a href="#" class="add-button">+ Add Task</a>
    </div>

    <div class="welcome">
        <h2>Good morning! 👋</h2>
        <p>Here's your task overview for today.</p>
    </div>

    <div class="stats">

        <div class="card">
            <h3>{{ $totalTasks }}</h3>
            <p>Total Tasks</p>
        </div>

        <div class="card">
            <h3>{{ $completedTasks }}</h3>
            <p>Completed</p>
        </div>

        <div class="card">
            <h3>{{ $pendingTasks }}</h3>
            <p>Pending</p>
        </div>

    </div>

    <div class="tasks">

        <h2>My Tasks</h2>

        @foreach ($tasks as $task)

            <div class="task">

                <div class="task-title">

                    @if ($task['status'] === 'Completed')
                        <span>✓</span>
                    @else
                        <span>○</span>
                    @endif

                    <span>{{ $task['title'] }}</span>

                </div>

                <span class="status
                    {{ $task['status'] === 'Completed' ? 'completed' : 'pending' }}">
                    {{ $task['status'] }}
                </span>

            </div>

        @endforeach

    </div>

</div>

</body>
</html>