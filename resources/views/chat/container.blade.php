<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Room</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-blue-800 p-4">
            <div class="container mx-auto">
                <a href="{{ route('chat.index') }}" class="text-white text-lg">Chat Room</a>

                <div class="float-right">
                    @auth
                        <span class="text-white">{{ Auth::user()->username }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline-block ml-4">
                            @csrf
                            <button type="submit" class="text-white">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-white">Login</a>
                    @endauth
                </div>
            </div>
        </nav>

        <div class="py-12">
            @yield('content')
        </div>
    </div>

    @vite('resources/js/app.js')
</body>

</html>
