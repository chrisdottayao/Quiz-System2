@extends('layouts.app')

@section('title', 'Edit Quiz')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Edit Quiz</h2>

    <form method="POST" action="{{ route('quizzes.update', $quiz->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Quiz Title</label>
            <input type="text" name="title" value="{{ old('title', $quiz->title) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $quiz->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Deadline</label>
            <input type="datetime-local" name="deadline" 
                   value="{{ old('deadline', \Carbon\Carbon::parse($quiz->deadline)->format('Y-m-d\TH:i')) }}" 
                   class="form-control">
        </div>

        <button type="submit" class="btn btn-success">💾 Update Quiz</button>
        <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">← Back</a>
    </form>
</div>
@endsection
