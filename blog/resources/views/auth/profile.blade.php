@extends('dashboard.layouts.app')

@section('title', 'Page Title')

@section('content')
<div class="mb-5">

    <h2 class="text-center py-5  text-lg md:text-2xl underline underline-offset-8">General Details</h2>
    <div class="w-1/2 m-auto">
        <div class="grid grid-cols-4 border-b-2 border-gray-200 py-3">
            <p class="font-bold text-lg col-span-1">
                Name:
            </p>
            <p class="col-span-3">
                {{$user->name}}
            </p>
        </div>
        <div class="grid grid-cols-4 gap-10 border-b-2 border-gray-200 py-3">
            <p class="font-bold text-lg col-span-1">
                Email:
            </p>
            <p class="col-span-3">
                {{$user->email}}
            </p>
        </div>
        <div class="grid grid-cols-4 gap-10 border-b-2 border-gray-200 py-3">
            <p class="font-bold text-lg col-span-1">
                Role:
            </p>
            <p class="col-span-3">
                {{$user->role}}
            </p>
        </div>
        <div class="grid grid-cols-4 gap-10 border-b-2 border-gray-200 py-3">
            <p class="font-bold text-lg col-span-1">
                Status:
            </p>
            <p class="col-span-3">
                {{$user->status}}
            </p>
        </div>
    </div>

</div>

<div class="mt-5">

    <h2 class="text-center py-5  text-lg md:text-2xl underline underline-offset-8">Address</h2>
       
   <div class="flex justify-around">
        @foreach ($user->addresses as $address)
        <div class=" border-b-2 border-gray-200 py-3"> 
                <h2 class="m-auto text-md md:text-xl py-2 underline underline-offset-4">{{$address->title}}</h2>

                @foreach (json_decode(json_encode($address)) as $key => $value)
                    @if($key == 'id' || $key == 'user_id' || $key == 'updated_at')
                        <?php  continue ;?>
                    @endif
                    <div class="grid grid-cols-4 gap-5 py-2">
                        <p class="font-bold text-lg col-span-1">
                            {{ ucfirst(str_replace('_', ' ', $key)) }}:
                        </p> 
                        <p class=" col-span-3">
                                @if($key == 'created_at')
                                {{ \Carbon\Carbon::parse($value)->diffForHumans() }}
                                @else
                                {{$value}};
                                @endif
                            
                        </p> 
                    </div>  
                @endforeach
            </div> 
        @endforeach
   </div>
 

</div>
@endsection