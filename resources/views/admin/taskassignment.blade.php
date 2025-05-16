@extends('layouts.admin')

@section('title', 'Register User')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Assigne Task</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('attach.task') }}">
                            @csrf
                          {{-- users --}}
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Users</label>
                                <select id="user_id" name="user_id"
                                    class="form-select @error('user_id') is-invalid @enderror" required>
                                    <option value="">— Select users —</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('project_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                         {{-- project --}}
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
                                <label for="task_id" class="form-label">Task</label>
                                <select id="task_id" name="task_id"
                                        class="form-select @error('task_id') is-invalid @enderror" required>
                                  <option value="">— Select Task —</option>
                                  @foreach($projects as $project)
                                      @foreach($project->tasks as $task)
                                        <option value="{{ $task->id }}"
                                          {{ old('task_id') == $task->id ? 'selected' : '' }}>
                                          {{ $task->title }}
                                        </option>
                                      @endforeach
                                  @endforeach
                                </select>
                                @error('task_id')
                                  <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                              </div>
                            

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
                                    <i class="bi bi-person-plus-fill me-2"></i> Assigne Task
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        // build a map of task_id → dates
        const taskDates = {};
        @foreach($projects as $project)
          @foreach($project->tasks as $t)
            taskDates[{{ $t->id }}] = {
              start: "{{ $t->start_date }}",
              end:   "{{ $t->end_date }}"
            };
          @endforeach
        @endforeach
    
        // when task changes, fill the date inputs
        document.getElementById('task_id').addEventListener('change', function() {
          const sel = this.value;
          const dates = taskDates[sel] || {start:'', end:''};
          document.getElementById('start_date').value = dates.start;
          document.getElementById('end_date').value   = dates.end;
        });
      </script>
@endsection



<script>
    document.addEventListener('DOMContentLoaded', () => {
        ClassicEditor
            .create(document.querySelector('#description'), {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'link', 'bulletedList', 'numberedList', 'blockQuote', '|',
                    'insertTable', 'imageUpload', 'mediaEmbed', '|',
                    'undo', 'redo'
                ],
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                },
                image: {
                    toolbar: ['imageTextAlternative', 'imageStyle:full', 'imageStyle:side']
                }
            })
            .catch(error => console.error(error));
    });
</script>

