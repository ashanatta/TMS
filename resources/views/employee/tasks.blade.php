@extends('layouts.employee')

@section('content')
<div class="container my-5">
  <h2 class="mb-4 text-primary fw-bold">📋 My Tasks</h2>

  @if($tasks->isEmpty())
    <div class="alert alert-info">You have no tasks assigned.</div>
  @else
    <div class="row row-cols-1 row-cols-md-2 g-4">
      @foreach($tasks as $task)
        @php
          $isCompleted = $task->pivot->status === 'completed';
        @endphp

        <div class="col">
          <div class="card shadow-sm border-0 h-100 {{ $isCompleted ? 'bg-light completed-card' : '' }}">
            <div class="card-body {{ $isCompleted ? 'text-muted' : '' }}">
              <h5 class="card-title text-dark fw-bold d-flex justify-content-between align-items-center">
                @if($isCompleted)
                  <span>{{ $task->title }}</span>
                  <span class="badge bg-success">✓ Completed</span>
                @else
                <a class="text-success" href="{{ route('tasks.info', $task->id) }}">{{ $task->title }}</a>
                @endif
              </h5>

              <span class="badge bg-secondary mb-2">
                📁 Project: {{ $task->project->project ?? '—' }}
              </span>

              <p class="card-text mb-2">
                📅 <strong>Start:</strong> {{ \Carbon\Carbon::parse($task->pivot->start_date)->format('d M Y') }} <br>
                📅 <strong>End:</strong> {{ \Carbon\Carbon::parse($task->pivot->end_date)->format('d M Y') }}
              </p>

              
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>

<style>
  .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
  }

  .completed-card {
    border-left: 5px solid #28a745;
    opacity: 0.85;
    pointer-events: none; /* disables all interactions */
    user-select: none;
  }

  select.form-select {
    cursor: pointer;
  }
</style>
@endsection
