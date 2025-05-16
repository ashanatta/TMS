@extends('layouts.employee')

@section('content')
<div class="container my-5">
  <h2 class="text-primary fw-bold mb-4">📌 Task Details</h2>

  <div class="card shadow border-0">
    <div class="card-body">
      <h4 class="card-title fw-bold text-success">{{ $task->title }}</h4>

      <p><strong>📁 Project:</strong> {{ $task->project->project ?? '—' }}</p>
      <p><strong>📅 Start Date:</strong> {{ \Carbon\Carbon::parse($task->pivot->start_date)->format('d M Y') }}</p>
      <p><strong>📅 End Date:</strong> {{ \Carbon\Carbon::parse($task->pivot->end_date)->format('d M Y') }}</p>
      <p><strong>🗂️ Status:</strong>
        @if($task->pivot->status === 'completed')
          <span class="badge bg-success">Completed</span>
        @elseif($task->pivot->status === 'inprogress')
          <span class="badge bg-warning text-dark">In Progress</span>
        @else
          <span class="badge bg-secondary">Incomplete</span>
        @endif
      </p>

      <a href="{{ route('employee.tasks') }}" class="btn btn-outline-primary mt-3">🔙 Back to My Tasks</a>
    </div>
  </div>
</div>
@endsection
