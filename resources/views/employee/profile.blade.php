@extends('layouts.employee')

@section('content')
    @php
        $disabled = $user->role === 'admin' ? 'disabled' : '';
    @endphp

    <div class="container my-5">
        <div class="card shadow-sm rounded-2">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Profile</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- Profile Preview --}}
                    <div class="col-md-4 text-center mb-4 mb-md-0">
                        <img src="{{ $user->image ? asset('storage/' . $user->image) : 'https://via.placeholder.com/150' }}"
                            alt="Profile Picture" class="img-fluid rounded-circle mb-3"
                            style="width:150px; height:150px; object-fit:cover;">
                        <h5 class="mb-1">{{ $user->name }}</h5>
                        <p class="text-muted small">{{ $user->bio ?? 'No bio available.' }}</p>
                    </div>

                    {{-- Edit Form --}}
                    <div class="col-md-8">
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3 mb-3">
                                <div class="col-sm-6 form-floating">
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        placeholder="Name" value="{{ old('name', $user->name) }}" required
                                        {{ $disabled }}>
                                    <label for="name">Name</label>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6 form-floating">
                                    <input type="date" name="dob"
                                        class="form-control @error('dob') is-invalid @enderror" id="dob"
                                        placeholder="Date of Birth" value="{{ old('dob', $user->dob) }}" required
                                        {{ $disabled }}>
                                    <label for="dob">Date of Birth</label>
                                    @error('dob')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" name="bio" class="form-control @error('bio') is-invalid @enderror"
                                    id="bio" placeholder="Bio" value="{{ old('bio', $user->bio) }}"
                                    {{ $disabled }}>
                                <label for="bio">Bio</label>
                                @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="image" class="form-label">Profile Photo</label>
                                <input class="form-control @error('image') is-invalid @enderror" type="file"
                                    id="image" name="image" accept="image/*" {{ $disabled }}>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            @empty($disabled)
                                <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                            @endempty

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
