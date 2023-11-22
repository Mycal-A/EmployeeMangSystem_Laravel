<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Employee Management System</title>
</head>

<body>
    <nav class="mt-2 navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <ul class="nav nav-pills">
                @can('admin')
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/adminHome">Home</a>
                </li>
                @endcan

                @auth
                <li class="nav-item">
                    <a class="nav-link disabled text-xl font-weight-bold text-dark">Welcome
                        {{auth()->user()->name}}!!</a>
                </li>
                <li class="nav-item ms-auto ">
                    <a class="btn btn-outline-danger" aria-current="page" href="/logout">Log Out</a>
                </li>
                @endauth

            </ul>
        </div>
    </nav>
    <div class="mt-6 mt-md-4">
        @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
        @endif
        {{ $slot }}
    </div>


</body>
