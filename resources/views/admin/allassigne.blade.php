@extends('layouts.admin')

@section('title', 'All Users')

@section('content')
  <h2 class="mb-4">All Projects</h2>

  <div class="table-responsive">
    <table id="assigne-Task-table" class="table table-striped table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">User</th>
          <th scope="col">Project</th>
          <th scope="col">Task</th>
          <th scope="col">Start-Date</th>
          <th scope="col">End-Date</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @php $i = 1; @endphp
        @forelse($assignedTasks as $task)
            @foreach($task->users as $user)
                <tr>
                    <td>{{ $loop->parent->iteration}}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $task->project->project ?? 'N/A' }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $user->pivot->start_date }}</td>
                    <td>{{ $user->pivot->end_date }}</td>
                    
                    <td>
                        <a href="{{ route('assigne.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
        @empty
        <tr>
            <td colspan="7" class="text-center">No assigned tasks found.</td>
          </tr>
          
        @endforelse
        </tbody>
        
    </table>
    <script>
        $(document).ready(function() {
            $('#assigne-Task-table').DataTable();
        });
    </script>
  </div>
@endsection
