@extends('dashboard.layouts.app')

@section('title', 'Page Title')

@section('content')
<div class="mb-5">

   <div class="grid place-items-center my-10">
        <h2 class=" text-center underline underline-offset-8 text-2xl mb-5">Profile Image</h2>
        <div class="grid place-items-center relative group w-32 h-32 md:w-60 md:h-60 p-2 rounded-full">
            <img src="{{$user->image}}" alt="{{$user->name}}" id="imagePreview" class="w-32 h-32 md:w-60 md:h-60 p-1 ring-2 ring-yellow-300 rounded-full inset-0 group-hover:opacity-50 shadow-md shadow-gray-900 object-cover object-center">
            <div class="w-32 h-32 md:w-60 md:h-60 absolute flex items-center justify-center transition-all transform translate-y-8 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 space-x-3">
                <label for="avatar" class="btn btn-primary cursor-pointer text-2xl text-red-600 grid place-items-center">
                    <img src="{{asset('assets/sync-alt-solid.svg')}}" class="w-10 h-10" alt="">
                </label>
                <input
                    id="avatar"
                    type="file"
                    name="image"
                    class="mt-1 form-controll cursor-pointer hidden"
                    onchange="saveImageWithPreview(this);"  

                />
            </div>
        </div>

   </div>
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
       
   <div class="flex justify-around gap-10">
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
@section('script')
<script>
    function saveImageWithPreview(input) {
        const imagePreview = document.getElementById('imagePreview');
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                
                // Save the image using Fetch API
                saveImageToServer(file);
            };

            reader.readAsDataURL(file);
        }
    }

    function saveImageToServer(file) {
        const formData = new FormData();
        formData.append('image', file);
        fetch('{{ route("admin.user.avatar.change", $user->id) }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (!data.error) {
                location.reload(); 
            }
        })
        .catch(error => {
            alert(error)
        });
    }


</script>
@endsection