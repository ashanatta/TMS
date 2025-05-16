@extends('layouts.guest')

@section('title', 'Dashboard')

@section('content')

    <body>


        @if ($errors->any())
            <div class="mb-4">
                <ul class="list-disc list-inside text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2>Task Mangement System </h2>
        <p>Our Home Page</p>
    @endsection
