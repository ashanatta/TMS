@extends('layouts.admin')

@section('title','Edit User')

@section('content')
  <h2 class="mb-4">Edit User</h2>
  
  <form method="POST" action="{{ route('users.update', $user->id) }}"  enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="mb-3">
      <label class="form-label">Name</label>
      <input name="name" value="{{ old('name',$user->name) }}"
             class="form-control @error('name') is-invalid @enderror" required>
      @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input name="email" type="email" value="{{ old('email',$user->email) }}"
             class="form-control @error('email') is-invalid @enderror" required>
      @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Role</label>
      <select name="role" class="form-select @error('role') is-invalid @enderror">
        <option value="employee"  {{ old('role',$user->role)=='employee'  ? 'selected':'' }}>employee</option>
        <option value="admin" {{ old('role',$user->role)=='admin' ? 'selected':'' }}>Admin</option>
      </select>
      @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Date of Birth</label>
      <input type="date" name="dob" value="{{ old('dob', $user->dob) }}"
             class="form-control @error('dob') is-invalid @enderror">
      @error('dob')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    
    <div class="mb-3">
      <label class="form-label">Bio</label>
      <textarea name="bio" rows="3"
                class="form-control @error('bio') is-invalid @enderror">{{ old('bio', $user->bio) }}</textarea>
      @error('bio')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    
    <div class="mb-3">
      <label class="form-label">Image</label>
      <input type="file" name="image"
             class="form-control @error('image') is-invalid @enderror" accept="image/*">
      @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
    
    </div>
    
    <button class="btn btn-success">Update User</button>
  </form>
@endsection
