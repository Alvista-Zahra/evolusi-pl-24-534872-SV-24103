<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Dashboard</title>

    <style>
        :root {
            --bg: #f4f7fb;
            --card: #ffffff;
            --primary: #1f2937;
            --muted: #6b7280;
            --border: #e5e7eb;
            --success-bg: #e8f8ee;
            --success-text: #1f8f5f;
            --warning-bg: #fff5d8;
            --warning-text: #a86b00;
            --shadow: 0 10px 25px rgba(15, 23, 42, 0.06);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: var(--bg);
            color: var(--primary);
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 20px 60px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 28px;
        }

        .header h1 {
            font-size: clamp(28px, 2vw, 36px);
            font-weight: 700;
        }

        .task-form {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
        }

        .task-form input {
            min-width: 260px;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 12px 14px;
            background: #fff;
            font-size: 14px;
            outline: none;
        }

        .task-form input:focus {
            border-color: #a5b4fc;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }

        .task-form button {
            border: none;
            background: var(--primary);
            color: #fff;
            padding: 12px 18px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .task-form button:hover {
            opacity: 0.96;
            transform: translateY(-1px);
        }

        .welcome {
            margin-bottom: 25px;
        }

        .welcome h2 {
            font-size: clamp(24px, 2vw, 30px);
            margin-bottom: 8px;
        }

        .welcome p {
            color: var(--muted);
            font-size: 15px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 35px;
        }

        .card {
            background: var(--card);
            padding: 24px 22px;
            border-radius: 14px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(17, 24, 39, 0.02);
        }

        .card h3 {
            font-size: 34px;
            margin-bottom: 6px;
            line-height: 1.1;
        }

        .card p {
            color: var(--muted);
            font-size: 14px;
        }

        .tasks {
            background: var(--card);
            border-radius: 14px;
            padding: 24px 20px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(17, 24, 39, 0.02);
        }

        .tasks h2 {
            margin-bottom: 16px;
            font-size: 24px;
        }

        .task {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid var(--border);
        }

        .task:last-child {
            border-bottom: none;
        }

        .task-title {
            display: flex;
            gap: 12px;
            align-items: center;
            min-width: 0;
        }

        .task-icon {
            width: 24px;
            height: 24px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: 700;
            background: #f3f4f6;
            color: var(--primary);
            flex-shrink: 0;
        }

        .task-title span:last-child {
            word-break: break-word;
        }

        .status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .completed {
            background: var(--success-bg);
            color: var(--success-text);
        }

        .pending {
            background: var(--warning-bg);
            color: var(--warning-text);
        }

        .empty-state {
            padding: 28px 16px 10px;
            text-align: center;
            color: var(--muted);
        }

        @media (max-width: 700px) {
            .stats {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .task-form {
                width: 100%;
            }

            .task-form input {
                width: 100%;
                min-width: 0;
            }

            .task {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Task Dashboard</h1>

            <form action="{{ route('tasks.store') }}" method="POST" class="task-form">
                @csrf
                <input
                    type="text"
                    name="title"
                    placeholder="Tambah tugas baru..."
                    required
                >
                <button type="submit">Tambah</button>
            </form>
        </div>

        <div class="welcome">
            <h2>Selamat pagi! 👋</h2>
            <p>Berikut ringkasan tugas Anda hari ini.</p>
        </div>

        <div class="stats">
            <div class="card">
                <h3>{{ $totalTasks }}</h3>
                <p>Total Tugas</p>
            </div>

            <div class="card">
                <h3>{{ $completedTasks }}</h3>
                <p>Selesai</p>
            </div>

            <div class="card">
                <h3>{{ $pendingTasks }}</h3>
                <p>Belum Selesai</p>
            </div>
        </div>

        <div class="tasks">
            <h2>Daftar Tugas</h2>

            @if ($tasks->isEmpty())
                <div class="empty-state">
                    Belum ada tugas yang ditambahkan.
                </div>
            @else
                @foreach ($tasks as $task)
                    <div class="task">
                        <div class="task-title">
                            <span class="task-icon">
                                {{ $task->status === 'Completed' ? '✓' : '○' }}
                            </span>
                            <span>{{ $task->title }}</span>
                        </div>

                        <span class="status {{ $task->status === 'Completed' ? 'completed' : 'pending' }}">
                            {{ $task->status }}
                        </span>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</body>
</html>