@extends('layouts.app')

@section('title', 'Add Questions')

@section('content')
    <h1>Add a Question</h1>

    <form method="POST" action="{{ route('questions.store') }}">
        @csrf

        <label>Quiz:</label>
        <select name="quiz_id" required>
            @foreach ($quizzes as $quiz)
                <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
            @endforeach
        </select><br><br>

        <label>Question Text:</label><br>
        <textarea name="question_text" required></textarea><br><br>

        <label>Option A:</label><input type="text" name="option_a" required><br>
        <label>Option B:</label><input type="text" name="option_b" required><br>
        <label>Option C:</label><input type="text" name="option_c"><br>
        <label>Option D:</label><input type="text" name="option_d"><br><br>

        <label>Correct Answer (A/B/C/D):</label>
        <input type="text" name="correct_answer" required><br><br>

        <button type="submit">Save Question</button>
    </form>

    <br>
    <a href="{{ url('/quizzes') }}">Back to Quizzes</a>
@endsection