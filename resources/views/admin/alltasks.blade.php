@extends('layouts.admin')

@section('title', 'All Tasks')

@section('content')
  <h2 class="mb-4">All Tasks</h2>

  <div class="table-responsive">
    <table id="tasks-table" class="table table-striped table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>Task-Title</th>
          <th>Project</th>
          <th>Description</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Created At</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tasks as $index => $task)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $task->title }}</td>
            <td>{{ $task->project->project ?? '-' }}</td>
            <td>{!! Str::limit(strip_tags($task->description), 50) !!}</td>
            <td>{{ $task->start_date }}</td>
            <td>{{ $task->end_date }}</td>
            <td>{{ $task->created_at->format('Y-m-d') }}</td>
            <td>
              <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-primary">Edit</a>
            
              <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    
  </div>
  <script>
    $(document).ready(function() {
        $('#tasks-table').DataTable();
    });
  </script>
@endsection


