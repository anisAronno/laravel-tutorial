<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
    @yield('css')
</head>
<body>




 
<div>
    @include('dashboard.layouts.sidebar')

    
    <div class="lg:pl-72">
        
        @include('dashboard.layouts.headers')

      <main class="py-10">
        <div class="px-4 sm:px-6 lg:px-8">
                @yield('content')
        </div>
      </main>
    </div>
  </div>
  



























    @yield('script')
</body>
</html>