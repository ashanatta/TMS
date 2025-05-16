@extends('layouts.admin')

@section('title', 'Edit Task')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-6">

      <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
          <h5 class="mb-0">Edit Task</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('tasks.update', $task->id) }}">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input
                id="title"
                name="title"
                type="text"
                class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title', $task->title) }}"
                required
              >
              @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Description --}}
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea
                id="description"
                name="description"
                class="form-control @error('description') is-invalid @enderror"
                required
              >{{ old('description', $task->description) }}</textarea>
              @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Start Date --}}
            <div class="mb-3">
              <label for="start_date" class="form-label">Start Date</label>
              <input
                id="start_date"
                name="start_date"
                type="date"
                class="form-control @error('start_date') is-invalid @enderror"
                value="{{ old('start_date', $task->start_date) }}"
                required
              >
              @error('start_date')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- End Date --}}
            <div class="mb-3">
              <label for="end_date" class="form-label">End Date</label>
              <input
                id="end_date"
                name="end_date"
                type="date"
                class="form-control @error('end_date') is-invalid @enderror"
                value="{{ old('end_date', $task->end_date) }}"
                required
              >
              @error('end_date')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Submit --}}
            <div class="d-grid">
              <button type="submit" class="btn btn-warning text-white">
                Update Task
              </button>
            </div>

          </form>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
