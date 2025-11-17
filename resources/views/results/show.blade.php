@extends('layouts.app')

@section('title', $quiz->title . ' - Take Quiz')

@section('content')
<div class="card p-4 shadow">
    <h2 class="mb-3 text-primary">{{ $quiz->title }}</h2>
    <p class="text-muted">{{ $quiz->description }}</p>

    @if ($quiz->questions->count() > 0)
        <form action="{{ route('results.store') }}" method="POST">
            @csrf
            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

            @foreach ($quiz->questions as $index => $question)
                <div class="card mb-3 p-3">
                    <h5 class="fw-bold">Question {{ $index + 1 }}:</h5>
                    <p>{{ $question->question_text }}</p>

                    @foreach (['option_a', 'option_b', 'option_c', 'option_d'] as $option)
                        <div class="form-check mb-2">
                            <input
                                type="radio"
                                name="answers[{{ $question->id }}]"
                                id="q{{ $question->id }}_{{ $option }}"
                                value="{{ $option }}"
                                class="form-check-input"
                                required
                            >
                            <label class="form-check-label" for="q{{ $question->id }}_{{ $option }}">
                                {{ $question->$option }}
                            </label>
                        </div>
                    @endforeach
                </div>
            @endforeach

            <button type="submit" class="btn btn-success mt-3">Submit Quiz</button>
        </form>
    @else
        <div class="alert alert-info">This quiz has no questions yet.</div>
    @endif

    <a href="{{ route('results.index') }}" class="btn btn-secondary mt-3">Back to Quizzes</a>
</div>
@endsection
