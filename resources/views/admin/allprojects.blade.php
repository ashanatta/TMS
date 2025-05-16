@extends('layouts.admin')

@section('title', 'All Users')

@section('content')
  <h2 class="mb-4">All Projects</h2>

  <div class="table-responsive">
    <table id="projects-table" class="table table-striped table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Date</th>
          <th scope="col">Acrion</th>
        </tr>
      </thead>
      <tbody>
        @forelse($projects as $project)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $project->project }}</td>
            <td>{{ $project->created_at->format('M j, Y') }}</td>
            <td>
              <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-primary">Edit</a>

              <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
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
            $('#projects-table').DataTable();
        });
    </script>
  </div>
@endsection
