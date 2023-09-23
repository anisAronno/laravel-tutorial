@extends('dashboard.layouts.app')

@section('title', 'Page Title')

@section('content')
    @foreach ($users as $user)
        
    <h1>{{$user->addresses}}</h1>
    @endforeach
@endsection