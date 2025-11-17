@extends('layouts.app')

@section('title', $quiz->title)

@section('content')
<div class="container py-4">
    <div class="card shadow-sm p-3">
        <div class="d-flex justify-content-between align-items-center">
            <h4>{{ $quiz->title }}</h4>
            @if($quiz->deadline)
                <div id="countdown" data-deadline="{{ $quiz->deadline->toIsoString() }}" class="fw-semibold text-danger"></div>
            @endif
        </div>

        <p class="text-muted">{{ $quiz->description }}</p>

        <form action="{{ route('results.store') }}" method="POST">
            @csrf
            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
            @foreach($quiz->questions as $q)
                <div class="mb-3">
                    <p class="mb-1"><strong>{{ $loop->iteration }}. {{ $q->question_text }}</strong></p>
                    @foreach(['option_a','option_b','option_c','option_d'] as $opt)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answers[{{ $q->id }}]" id="q{{ $q->id }}{{ $opt }}" value="{{ $q->$opt }}">
                            <label class="form-check-label" for="q{{ $q->id }}{{ $opt }}">
                                {{ $q->$opt }}
                            </label>
                        </div>
                    @endforeach
                </div>
            @endforeach

            <button class="btn btn-success">Submit Quiz</button>
        </form>
    </div>
</div>

@if($quiz->deadline && now()->lessThan($quiz->deadline))
<script>
(function(){
  function update(){
    const el = document.getElementById('countdown'); if(!el) return;
    const deadline = new Date(el.dataset.deadline);
    const diff = deadline - new Date();
    if(diff <= 0) { el.innerText = 'Closed'; return; }
    const hrs = Math.floor(diff/1000/60/60);
    const mins = Math.floor((diff/1000/60)%60);
    const secs = Math.floor((diff/1000)%60);
    el.innerText = 'Closes in: ' + hrs + 'h ' + mins + 'm ' + secs + 's';
  }
  update(); setInterval(update,1000);
})();
</script>
@endif
@endsection
