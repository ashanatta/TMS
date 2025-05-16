@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<style>
    .module-card {
  transition: transform .2s, box-shadow .2s;
}
.module-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important;
}
/* If you used bg-light for a card, make text dark */
.bg-light.text-white {
  color: #343a40 !important;
}

</style>
  <div class="container my-4">
    <h1 class="mb-4">Admin Dashboard</h1>
    <div class="row g-4">
      @php
        $modules = [
          [
            'title'=>'Register User',
            'route'=>'register',
            'icon'=>'fa-user-plus',
            'color'=>'bg-primary',
          ],
          [
            'title'=>'New Project',
            'route'=>'project.create',
            'icon'=>'fa-folder-plus',
            'color'=>'bg-success',
          ],
          [
            'title'=>'New Task',
            'route'=>'task.create',
            'icon'=>'fa-tasks',
            'color'=>'bg-warning',
          ],
          [
            'title'=>'Assign Task',
            'route'=>'task.assigne',
            'icon'=>'fa-user-check',
            'color'=>'bg-info',
          ],
          
        ];
      @endphp

      @foreach($modules as $mod)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <a href="{{ route($mod['route']) }}" class="text-decoration-none">
            <div class="card h-100 {{ $mod['color'] }} text-white rounded-3 shadow-sm module-card">
              <div class="card-body d-flex flex-column justify-content-center align-items-center p-4">
                <i class="fas {{ $mod['icon'] }} fa-2x mb-3"></i>
                <h5 class="card-title text-center">{{ $mod['title'] }}</h5>
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  </div>

  
@endsection
