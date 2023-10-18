@extends('layouts.app')

@section('title', 'Page Title')

@section('content') 
@include('layouts.header', ['title' => 'About Page', 'subTitle' => 'Lorem Ipsum Dolor Sit Amet'])

<div class="w-full grid grid-cols-2 gap-10 flex-wrap p-10">
    <div class="col-span-1">
        <h1 class=" text-4xl underline underline-offset-8 pb-5">About us</h1>
        <p>{{ getSettings('about_us_content') }}</p>
    </div>
    <div class=" col-span-1 max-w-fit" >
        <img src="{{Storage::url('placeholder.jpeg')}}" alt="" class="w-full h-auto">
    </div>
</div>

@endsection
