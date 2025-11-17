@extends('layouts.app')

@section('title','Student Dashboard')

@section('content')
<div class="container py-5" style="animation: fadeIn 1s ease;">
    <div class="text-center mb-4">
        <img src="{{ asset('images/psau_logo.png') }}" alt="PSAU" width="80" class="mb-2">
        <h2 class="fw-bold text-success">Student Dashboard</h2>
        <p class="text-muted">Welcome, {{ auth()->user()->name }}</p>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5 class="fw-bold">My Subjects</h5>
                <p class="display-6">{{ auth()->user()->subjects()->count() }}</p>
                <a href="{{ route('subjects.index') }}" class="btn btn-sm btn-success">View Subjects</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5 class="fw-bold">Quizzes Available</h5>
                <p class="display-6">{{ \App\Models\Quiz::whereIn('subject_id', auth()->user()->subjects()->pluck('subjects.id'))->where(function($q){ $q->whereNull('deadline')->orWhere('deadline','>', now()); })->count() }}</p>
                <a href="{{ route('results.index') }}" class="btn btn-sm btn-success">Take Quiz</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5 class="fw-bold">My Scores</h5>
                <p class="display-6">{{ \App\Models\Result::where('user_id', auth()->id())->count() }}</p>
                <a href="{{ route('results.myScores') }}" class="btn btn-sm btn-success">View Scores</a>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <h5 class="fw-bold">Upcoming Quizzes</h5>
        <div class="row">
            @foreach(\App\Models\Quiz::whereIn('subject_id', auth()->user()->subjects()->pluck('subjects.id'))->whereNotNull('deadline')->where('deadline','>', now())->orderBy('deadline')->take(6)->get() as $qz)
                <div class="col-md-4">
                    <div class="card p-2 mb-2">
                        <h6 class="mb-1">{{ $qz->title }}</h6>
                        <small class="text-muted">{{ $qz->subject->name ?? 'No Subject' }}</small>
                        <div><small>Due: {{ $qz->deadline->diffForHumans() }}</small></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
