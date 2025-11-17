@extends('layouts.app')

@section('title', 'Create Subject')

@section('content')
<div class="d-flex justify-content-center align-items-center" 
     style="min-height: 100vh; background: linear-gradient(135deg, #006400, #228B22);">

    <div class="card shadow-lg p-4" style="width: 450px; border-radius: 15px;">
        <h3 class="fw-bold text-success text-center mb-3">Create Subject</h3>

        <form action="{{ route('subjects.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Subject Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <button class="btn btn-success w-100 fw-bold">Create Subject</button>

            <div class="text-center mt-3">
                <a href="{{ route('subjects.index') }}" class="text-white fw-bold">Back to Subjects</a>
            </div>
        </form>
    </div>
</div>
@endsection
