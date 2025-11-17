<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quiz System')</title>

    <!-- ✅ Load Bootstrap via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body style="background: linear-gradient(180deg, #f4f6f9 0%, #e9ecf2 100%); min-height:100vh;">
    <!-- ✅ Navbar -->
   <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #006400;">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-white" href="{{ route('go.dashboard') }}">Simple Quiz System</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        @auth
          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('go.dashboard') }}">🏠 Dashboard</a>
          </li>

          @if(auth()->user()->role === 'teacher')
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('quizzes.index') }}">📝 Manage Quizzes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('results.all') }}">📊 All Results</a>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('results.index') }}">🧠 Take Quiz</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('results.myScores') }}">📋 My Scores</a>
            </li>
          @endif

          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('profile') }}">👤 Profile</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('about') }}">ℹ️ About</a>
          </li>

          <a href="#" class="nav-link text-white" 
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
   🚪 Logout
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
    
        @endauth
      </ul>
    </div>
  </div>
</nav>


    <!-- ✅ Page Content -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- ✅ Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<footer class="text-center py-3 mt-5 bg-light border-top">
    <small>© 2025 Simple Quiz System | Developed by PSAU IT Student</small>
</footer>

</html>
