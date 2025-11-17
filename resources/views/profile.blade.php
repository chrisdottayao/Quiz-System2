@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-header text-center bg-success text-white">
            <h3>👤 My Profile</h3>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p><strong>Role:</strong> {{ ucfirst(auth()->user()->role) }}</p>

            <a href="{{ route('go.dashboard') }}" class="btn btn-secondary mt-3">⬅ Back to Dashboard</a>
        </div>
    </div>
</div>
@endsection
