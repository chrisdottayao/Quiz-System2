@extends('layouts.app')

@section('title','My Scores')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold text-success mb-3">My Scores</h3>

    <table class="table table-striped">
        <thead>
            <tr><th>Quiz</th><th>Subject</th><th>Score</th><th>Date</th></tr>
        </thead>
        <tbody>
            @foreach($results as $r)
            <tr>
                <td>{{ $r->quiz->title }}</td>
                <td>{{ $r->quiz->subject->name ?? '-' }}</td>
                <td>{{ $r->score }}</td>
                <td>{{ $r->created_at->format('M d, Y h:i A') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
