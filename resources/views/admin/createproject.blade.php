@extends('layouts.admin')

@section('title', 'Register User')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-6">

      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">New Project</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('project.store') }}">
            @csrf

            {{-- Name --}}
            <div class="mb-3">
              <label for="project" class="form-label">Project</label>
              <input
                id="project"
                name="project"
                type="text"
                class="form-control @error('project') is-invalid @enderror"
                value="{{ old('project') }}"
                required
                autofocus
              >
              @error('project')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            {{-- Submit --}}
            <div class="d-grid">
              <button type="submit" class="btn btn-success">
                <i class="bi bi-person-plus-fill me-2"></i> New Project
              </button>
            </div>

          </form>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
