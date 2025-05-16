
@extends('layouts.employee')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Hello, {{ auth()->user()->name }}</h1>
    <h1 class="text-2xl font-semibold mb-4">your Role is, {{ auth()->user()->role }}</h1>
    <body>
      
@endsection
