<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>postes</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}" </head>

<body class="bg-gray-100">
    <nav class="p-6 bg-white flex justify-between mb-4">
        <ul class="flex items-center">
            <li><a class="p-3" href="">Home</a>
            </li>
            <li> <a class="p-3" href="">Dashbord</a></li>
            <li><a class="p-3" href="">Post</a></li>

        </ul>

        <ul class="flex items-center">
            @auth
            <li>
                <a href="" class="p-3">{{ auth()->user()->name }}</a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="post" class="p-3 inline">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
            @endauth

            @guest
            <li> <a class="p-3" href="{{ route('login') }}">Login</a></li>
            <li><a class="p-3" href="{{route('register')}} ">Register</a></li>

            @endguest
        </ul>

    </nav>
    @yield('content')
</body>

</html>
