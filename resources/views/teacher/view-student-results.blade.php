@extends('layouts.app')

@section('title','Student Results')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold text-success mb-3">Results for {{ $user->name }}</h3>

    <table class="table table-bordered">
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

    <a href="{{ route('results.all') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
