@extends('layouts.app')

@section('title', 'Subjects')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4 text-success">Subjects</h2>

    <div class="d-flex justify-content-between mb-3">
        @if(auth()->user()->role === 'teacher')
            <a href="{{ route('subjects.create') }}" class="btn btn-success">+ Create Subject</a>
        @endif

        @if(auth()->user()->role === 'student')
            <a href="{{ route('subjects.joinForm') }}" class="btn btn-warning text-dark fw-bold">Join Subject</a>
        @endif
    </div>

    <div class="row">
        @forelse($subjects as $subject)
        <div class="col-md-4">
            <div class="card shadow-sm mb-4" style="border-radius: 15px;">
                <div class="card-body">
                    <h5 class="fw-bold text-success">{{ $subject->name }}</h5>
                    <p class="text-muted">{{ $subject->description }}</p>

                    <p class="small text-secondary mb-2">
                        Code: <span class="fw-bold">{{ $subject->code }}</span>
                    </p>

                    @if(auth()->user()->role === 'teacher')
                        <a href="{{ route('subjects.missed', $subject->id) }}" 
                           class="btn btn-outline-danger btn-sm mt-2">View Missed Deadlines</a>
                    @endif
                </div>
            </div>
        </div>
        @empty
            <p>No subjects found.</p>
        @endforelse
    </div>
</div>
@endsection
