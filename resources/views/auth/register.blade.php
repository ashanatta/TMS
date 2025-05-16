{{-- resources/views/admin/register.blade.php --}}
@extends('layouts.admin')

@section('title', 'Register User')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-6">

      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">Register New User</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Name --}}
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input
                id="name"
                name="name"
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}"
                required
                autofocus
              >
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input
                id="email"
                name="email"
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}"
                required
              >
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input
                id="password"
                name="password"
                type="password"
                class="form-control @error('password') is-invalid @enderror"
                required
              >
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-3">
              <label for="password_confirmation" class="form-label">Confirm Password</label>
              <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                class="form-control"
                required
              >
            </div>

            {{-- Role --}}
            <div class="mb-4">
              <label for="role" class="form-label">Role</label>
              <select
                id="role"
                name="role"
                class="form-select @error('role') is-invalid @enderror"
                required
              >
                <option value="employee" {{ old('role')=='employee' ? 'selected':'' }}>Employee</option>
                <option value="admin"    {{ old('role')=='admin'    ? 'selected':'' }}>Admin</option>
                <option value="manager"    {{ old('role')=='manager'    ? 'selected':'' }}>manager</option>
              </select>
              @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Submit --}}
            <div class="d-grid">
              <button type="submit" class="btn btn-success">
                <i class="bi bi-person-plus-fill me-2"></i> Register User
              </button>
            </div>

          </form>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
