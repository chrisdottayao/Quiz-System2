@extends('layouts.app')

@section('title', 'My Scores')

@section('content')
    <h1>{{ $quiz->title }}</h1>
    <p>{{ $quiz->description }}</p>
    @if($quiz->deadline && now()->lessThan($quiz->deadline))
  <div id="countdown" data-deadline="{{ $quiz->deadline->toIsoString() }}"></div>

  <script>
  (function(){
    function update(){
      const el = document.getElementById('countdown');
      if(!el) return;
      const deadline = new Date(el.dataset.deadline);
      const now = new Date();
      const diff = deadline - now;
      if(diff <= 0) {
        el.innerText = 'Closed';
        return;
      }
      const hrs = Math.floor(diff/1000/60/60);
      const mins = Math.floor((diff/1000/60)%60);
      const secs = Math.floor((diff/1000)%60);
      el.innerText = 'Closes in: ' + hrs + 'h '+ mins + 'm ' + secs + 's';
    }
    update();
    setInterval(update,1000);
  })();
  </script>
@endif
    @php
  $status = 'Open';
  if ($quiz->deadline) {
    if (now()->greaterThan($quiz->deadline)) $status = 'Closed';
    elseif ($quiz->deadline->diffInHours(now()) <= 24) $status = 'Upcoming';
  }
@endphp

<span class="badge 
    {{ $status == 'Open' ? 'bg-success' : ($status == 'Upcoming' ? 'bg-warning text-dark' : 'bg-danger') }}">
  {{ $status }}
</span>
    <h3>Questions</h3>

    @if ($quiz->questions->count() > 0)
        <ul>
            @foreach ($quiz->questions as $question)
                <li>
                    <strong>{{ $question->question_text }}</strong><br>
                    A. {{ $question->option_a }} <br>
                    B. {{ $question->option_b }} <br>
                    @if ($question->option_c)
                        C. {{ $question->option_c }} <br>
                    @endif
                    @if ($question->option_d)
                        D. {{ $question->option_d }} <br>
                    @endif
                </li>
                <hr>
            @endforeach
        </ul>
    @else
        <p>No questions added yet.</p>
    @endif

    <br>

    <!-- Link to Add New Question -->
    <a href="{{ route('questions.create') }}">Add Another Question</a>
    <br><br>

    <!-- Link to Take the Quiz -->
    <a href="{{ route('results.show', $quiz->id) }}">
        <button>Take This Quiz</button>
    </a>

    <br><br>
    <a href="{{ route('quizzes.index') }}">Back to Quizzes</a>
    <br>
    <a href="{{ route('results.all') }}">
    <button>View All Student Scores</button>
</a>

@endsection