@extends('layouts.app')

@section('title', 'Create a New Quizz')

@section('content')
    <h1>Create a New Quiz</h1>

    <form method="POST" action="{{ route('quizzes.store') }}">
        @csrf
        <label>Title:</label>
        <div class="mb-3">
            <div class="mb-3">
  <label for="subject_id" class="form-label">Assign to Subject</label>
  <select name="subject_id" id="subject_id" class="form-control">
    <option value="">-- Select Subject --</option>
    @foreach($subjects as $s)
      <option value="{{ $s->id }}" {{ old('subject_id', $quiz->subject_id ?? '') == $s->id ? 'selected' : '' }}>
        {{ $s->name }}
      </option>
    @endforeach
  </select>
</div>
        <input type="text" name="title" required><br><br>

        <label>Description:</label>
        <textarea name="description"></textarea><br><br>
        
    <div class="mb-3">
    <label for="deadline" class="form-label">Quiz Deadline</label>
    <input type="datetime-local" name="deadline" id="deadline" class="form-control" 
           value="{{ old('deadline', isset($quiz) ? $quiz->deadline : '') }}">
           
</div>
    </form>
    <div class="mb-3">
    <label for="classroom_id" class="form-label">Assign to Class</label>
    <select name="classroom_id" id="classroom_id" class="form-control" required>
        <option value="">-- Select class --</option>
        @foreach(auth()->user()->classesTeaching as $c)
            <option value="{{ $c->id }}" {{ old('classroom_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
        @endforeach
    </select>
</div>

</body>
</html>
@endsection