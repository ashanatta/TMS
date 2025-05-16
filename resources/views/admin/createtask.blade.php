@extends('layouts.admin')

@section('title', 'Register User')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">New Task</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('task.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="project_id" class="form-label">Project</label>
                                <select id="project_id" name="project_id"
                                    class="form-select @error('project_id') is-invalid @enderror" required>
                                    <option value="">— Select Project —</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}"
                                            {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                            {{ $project->project }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('project_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Title --}}
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input id="title" name="title" type="text"
                                    class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"
                                    required autofocus>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" ></textarea>

                            {{-- Start Date --}}
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input id="start_date" name="start_date" type="date"
                                    class="form-control @error('start_date') is-invalid @enderror"
                                    value="{{ old('start_date') }}" required>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- End Date --}}
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input id="end_date" name="end_date" type="date"
                                    class="form-control @error('end_date') is-invalid @enderror"
                                    value="{{ old('end_date') }}" required>
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Submit --}}
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-person-plus-fill me-2"></i> Create Task
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection



