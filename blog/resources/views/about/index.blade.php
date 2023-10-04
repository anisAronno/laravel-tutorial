@extends('layouts.app')

@section('title', 'Page Title')

@section('content') 

<div class="w-full grid grid-cols-2 gap-10 flex-wrap p-10">
    <div class="col-span-1">
        <h1 class=" text-4xl underline underline-offset-8 pb-5">About us</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam quo repudiandae atque sed vitae quasi eum deleniti sunt nostrum cumque fugiat, nam qui quibusdam ad quam. Amet est praesentium aut, incidunt voluptate tempore. Voluptas itaque laudantium veritatis dolores ut eos molestiae, nam rerum ducimus reprehenderit voluptatum eum! Totam fugiat adipisci accusantium aperiam earum nisi eveniet, animi praesentium mollitia non enim inventore sunt labore unde rem in maiores quae voluptate. Explicabo, magni deleniti iusto veritatis, facere itaque inventore velit molestias incidunt cum perferendis eos, dolores accusantium eveniet necessitatibus repudiandae provident ipsum unde commodi consectetur. Doloremque incidunt harum rem unde voluptas dolorum iusto itaque, corrupti error repudiandae dicta sint cum, deserunt assumenda? Accusantium aspernatur veritatis, atque dignissimos aut blanditiis veniam consequuntur dicta consequatur accusamus magni velit harum nam labore ab? Et mollitia magni assumenda nam ipsum! Blanditiis aperiam quam, soluta tenetur aut, adipisci deleniti iure voluptatibus sint quisquam eligendi enim beatae? Tempore temporibus vitae sunt quisquam? Doloribus repellat quidem, architecto in ex obcaecati minima labore vitae pariatur, consequuntur fugit doloremque ea provident at mollitia aliquam repellendus omnis hic unde. Voluptate suscipit laudantium placeat dicta iste. Dolorem, officia magni molestias dolor amet mollitia excepturi accusantium cum, id libero sed rem alias provident in.</p>
    </div>
    <div class=" col-span-1 max-w-fit" >
        <img src="{{Storage::url('placeholder.jpeg')}}" alt="" class="w-full h-auto">
    </div>
</div>

@endsection
