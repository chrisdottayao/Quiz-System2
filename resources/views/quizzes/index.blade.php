@extends('layouts.app')

@section('title','Available Quizzes')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold text-success mb-3">Available Quizzes</h3>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

    <div class="row">
        @forelse($quizzes as $quiz)
            <div class="col-md-4">
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold">{{ $quiz->title }}</h5>
                        <p class="small text-muted">{{ $quiz->description }}</p>

                        <div class="mb-2">
                            <small class="text-secondary">{{ $quiz->subject->name ?? 'No Subject' }}</small>
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
                        </div>

                        <div class="d-flex justify-content-between">
                            @if(auth()->user()->role === 'teacher')
                                <div>
                                    <a href="{{ route('quizzes.edit', $quiz->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this quiz?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                                <a href="{{ route('results.all') }}" class="btn btn-sm btn-outline-primary">Results</a>
                            @else
                                @if($quiz->deadline && now()->greaterThan($quiz->deadline))
                                    <button class="btn btn-sm btn-secondary" disabled>Closed</button>
                                @else
                                    <a href="{{ route('results.show', $quiz->id) }}" class="btn btn-sm btn-success">Take Quiz</a>
                                @endif
                                <a href="{{ route('results.myScores') }}" class="btn btn-sm btn-outline-secondary">My Scores</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>No quizzes available.</p>
        @endforelse
    </div>
</div>
@endsection
