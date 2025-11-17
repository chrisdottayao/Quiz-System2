@extends('layouts.app')

@section('title', '{{ $quiz->title }}')

@section('content')
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
<body>
    <h1>Questions for {{ $quiz->title }}</h1>

    <a href="{{ route('questions.create') }}">Add Question</a>

    <ul>
        @foreach ($questions as $question)
            <li>
                <strong>{{ $question->question_text }}</strong><br>
                A. {{ $question->option_a }}<br>
                B. {{ $question->option_b }}<br>
                @if ($question->option_c)
                    C. {{ $question->option_c }}<br>
                @endif
                @if ($question->option_d)
                    D. {{ $question->option_d }}<br>
                @endif
                <em>Correct Answer: {{ $question->correct_answer }}</em>
            </li>
            <br>
        @endforeach
    </ul>

    <a href="{{ route('quizzes.index') }}">Back to Quizzes</a>
@endsection