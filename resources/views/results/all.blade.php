@extends('layouts.app')

@section('title', 'All Quiz Results')

@section('content')
<div class="card p-4 shadow">
    <h2 class="text-primary mb-4">📊 All Student Results</h2>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">All Results</h4>
    <div>
        <a href="{{ route('results.exportPDF') }}" class="btn btn-danger btn-sm">🧾 Download PDF</a>
        <button onclick="exportTableToExcel('resultsTable', 'quiz_results')" class="btn btn-success btn-sm">
            📊 Download Excel (Lite)
        </button>
    </div>
</div>

    <!-- ✅ Filter by Quiz -->
    <form method="GET" action="{{ route('results.all') }}" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <select name="quiz" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Filter by Quiz --</option>
                    @foreach ($quizzes as $q)
                        <option value="{{ $q->id }}" {{ request('quiz') == $q->id ? 'selected' : '' }}>
                            {{ $q->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    @if ($results->count() > 0)
       <table id="resultsTable" class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>Student Name</th>
                    <th>Quiz Title</th>
                    <th>Score</th>
                    <th>Date Taken</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $result)
                    <tr>
                        <td>{{ $result->user->name }}</td>
                        <td>{{ $result->quiz->title }}</td>
                        <td>{{ $result->score }}</td>
                        <td>{{ $result->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('teacher.viewStudentResults', $result->user->id) }}" class="btn btn-sm btn-outline-primary">
                                View Student
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">No quiz results found.</div>
    @endif

    <a href="{{ route('teacher.dashboard') }}" class="btn btn-secondary mt-3">⬅ Back to Dashboard</a>
</div>
<script>
function exportTableToExcel(tableID, filename = ''){
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    filename = filename ? filename + '.xls' : 'excel_data.xls';
    var downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);
    downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    downloadLink.download = filename;
    downloadLink.click();
}
</script>
@endsection
