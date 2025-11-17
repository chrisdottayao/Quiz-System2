@extends('layouts.app')

@section('title', 'Available Quizzes')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Available Quizzes</h1>
        @php
  $status = 'Open';
  if ($quiz->deadline) {
    if (now()->greaterThan($quiz->deadline)) $status = 'Closed';
    elseif ($quiz->deadline->diffInHours(now()) <= 24) $status = 'Upcoming';
  }
@endphp

<span class="badge {{ $status == 'Open' ? 'bg-success' : ($status == 'Upcoming' ? 'bg-warning text-dark' : 'bg-danger') }}">
  {{ $status }}
</span>
@if($quiz->deadline && now()->lessThan($quiz->deadline))
  <div id="countdown" data-deadline="{{ $quiz->deadline->toIsoString() }}"></div>
  <script>
  (function(){
    function update(){
      const el = document.getElementById('countdown'); if(!el) return;
      const deadline = new Date(el.dataset.deadline);
      const diff = deadline - new Date();
      if(diff <= 0){ el.innerText = 'Closed'; return; }
      const hrs = Math.floor(diff/1000/60/60);
      const mins = Math.floor((diff/1000/60)%60);
      const secs = Math.floor((diff/1000)%60);
      el.innerText = 'Closes in: ' + hrs + 'h '+ mins + 'm ' + secs + 's';
    }
    update(); setInterval(update,1000);
  })();
  </script>
@endif
        @if ($quizzes->count() > 0)
            <ul class="list-group mb-3">
                @foreach ($quizzes as $quiz)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ route('results.show', $quiz->id) }}" class="fw-bold text-decoration-none">
                            {{ $quiz->title }}</a>
                             @if ($quiz->deadline)
                             <span class="text-sm text-gray-500">
                                (Deadline: {{ \Carbon\Carbon::parse($quiz->deadline)->format('M d, Y h:i A') }})
                            </span>
                            @endif
                        </li>
                        <span class="badge bg-primary">Take Quiz</span>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="alert alert-info">No quizzes available at the moment.</div>
        @endif

        <a href="{{ route('student.dashboard') }}" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>
@endsection
