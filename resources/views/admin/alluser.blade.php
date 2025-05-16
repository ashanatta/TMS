@extends('layouts.admin')

@section('title', 'All Users')

@section('content')
  <h2 class="mb-4">All Users</h2>

  <div class="table-responsive">
    <table id="users-table" class="table table-striped table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Role</th>
          <th scope="col">Registered At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $user)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
              <span class="badge bg-{{ $user->role === 'admin' ? 'success' : 'secondary' }}">
                {{ ucfirst($user->role) }}
              </span>
            </td>
            <td>{{ $user->created_at->format('M j, Y') }}</td>
            <td>
              <a href="{{ route('users.edit', $user->id) }}"
                 class="btn btn-sm btn-primary">Edit</a>

              <form action="{{ route('users.destroy', $user->id) }}"
                    method="POST"
                    class="d-inline"
                    onsubmit="return confirm('Delete this user?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center">No users found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $('#users-table').DataTable();
        });
    </script>
  </div>
@endsection
