@extends('layouts.app')

@section('title','Teacher Dashboard')

@section('content')
<div class="container py-5" style="animation: fadeIn 1s ease;">
    <div class="text-center mb-4">
        <img src="{{ asset('images/psau_logo.png') }}" alt="PSAU" width="80" class="mb-2">
        <h2 class="fw-bold text-success">Teacher Dashboard</h2>
        <p class="text-muted">Welcome, {{ auth()->user()->name }}</p>
    </div>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm">
                <h5 class="fw-bold">My Subjects</h5>
                <p class="display-6">{{ auth()->user()->subjectsTeaching()->count() }}</p>
                <a href="{{ route('subjects.index') }}" class="btn btn-sm btn-success">Manage Subjects</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 shadow-sm">
                <h5 class="fw-bold">My Quizzes</h5>
                <p class="display-6">{{ \App\Models\Quiz::where('user_id',auth()->id())->orWhereHas('subject', function($q){ $q->where('teacher_id', auth()->id()); })->count() }}</p>
                <a href="{{ route('quizzes.index') }}" class="btn btn-sm btn-success">Manage Quizzes</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 shadow-sm">
                <h5 class="fw-bold">Upcoming Deadlines</h5>
                <ul class="list-unstyled small">
                    @foreach(\App\Models\Quiz::whereHas('subject', function($q){ $q->where('teacher_id', auth()->id()); })->whereNotNull('deadline')->where('deadline','>', now())->orderBy('deadline')->take(5)->get() as $qz)
                        <li>{{ $qz->title }} — {{ $qz->deadline->format('M d, h:i A') }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 shadow-sm">
                <h5 class="fw-bold">Students Enrolled</h5>
                <p class="display-6">{{ \DB::table('subject_user')->join('subjects','subject_user.subject_id','=','subjects.id')->where('subjects.teacher_id', auth()->id())->count() }}</p>
                <a href="{{ route('subjects.index') }}" class="btn btn-sm btn-success">View Subjects</a>
            </div>
        </div>
    </div>
</div>
@endsection
