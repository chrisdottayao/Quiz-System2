@extends('layouts.app')

@section('title', 'Missed Deadlines')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-danger mb-4">Missed Quiz Deadlines — {{ $subject->name }}</h2>

    @if(empty($missed))
        <div class="alert alert-success">No missed quizzes! 🎉</div>
    @else
        <table class="table table-bordered shadow-sm">
            <thead class="table-danger">
                <tr>
                    <th>Student</th>
                    <th>Quiz</th>
                    <th>Deadline</th>
                </tr>
            </thead>
            <tbody>
                @foreach($missed as $row)
                <tr>
                    <td class="fw-bold">{{ $row['student']->name }}</td>
                    <td>{{ $row['quiz']->title }}</td>
                    <td class="text-danger fw-semibold">
                        {{ $row['quiz']->deadline->format('M d, Y h:i A') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('subjects.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
