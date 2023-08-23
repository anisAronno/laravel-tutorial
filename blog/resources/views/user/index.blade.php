@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

<section class="p-20">
    @foreach ($users as $key=>$user)
    <div class="flex m-5">
        <div>
            <p>{{$key+1}} &nbsp;</p>
        </div>
       <div>
        <p>Name: {{$user->name}}</p>
        <p>Email:{{$user->email}}</p>
        <p>Password: {{$user->password}}</p>
       </div>
    </div>
    @endforeach
</section>

@endsection
