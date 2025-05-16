@extends('layouts.admin')

@section('title', 'Edit Project')

@section('content')
  <h2>Edit Project</h2>

  <form method="POST" action="{{ route('projects.update', $project->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="project" class="form-label">Project Name</label>
      <input type="text" name="project" id="project" class="form-control" value="{{ old('project', $project->project) }}" required>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
  </form>
@endsection
