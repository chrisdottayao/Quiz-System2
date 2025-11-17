@extends('layouts.app')

@section('title', 'Join Subject')

@section('content')
<div class="d-flex justify-content-center align-items-center"
     style="min-height: 100vh; background: linear-gradient(135deg, #006400, #228B22);">

    <div class="card shadow-lg p-4" style="width: 450px; border-radius: 15px;">
        <h3 class="fw-bold text-success text-center mb-3">Join Subject</h3>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('subjects.join') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Subject Code</label>
                <input type="text" name="code" class="form-control" placeholder="Enter code (e.g. ABC123)" required>
            </div>

            <button class="btn btn-warning w-100 fw-bold text-dark">Join Subject</button>

            <div class="text-center mt-3">
                <a href="{{ route('subjects.index') }}" class="text-white fw-bold">Back to Subjects</a>
            </div>
        </form>
    </div>
</div>
@endsection
