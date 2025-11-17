<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Simple Quiz System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #006400, #228B22);
            color: white;
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        .hero {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 2rem;
        }
        h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        p {
            font-size: 1.2rem;
            max-width: 600px;
            margin-bottom: 2rem;
        }
        .btn-custom {
            background-color: #FFD700;
            color: #006400;
            font-weight: bold;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            text-transform: uppercase;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background-color: #fff;
            color: #006400;
            transform: scale(1.05);
        }
        footer {
            background-color: rgba(0, 0, 0, 0.2);
            text-align: center;
            padding: 10px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="hero">
        <h1>Welcome to Simple Quiz System 🎓</h1>
        <p>An interactive platform for teachers to create quizzes and students to learn efficiently — powered by Laravel & MySQL.</p>

        @auth
            <a href="{{ route('go.dashboard') }}" class="btn btn-custom">Go to Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-custom">Login</a>
            <a href="{{ route('register') }}" class="btn btn-light ms-2 text-success">Register</a>
        @endauth
    </div>

    <footer>
        © 2025 Simple Quiz System | Developed by PSAU IT Students
    </footer>
</body>
</html>
