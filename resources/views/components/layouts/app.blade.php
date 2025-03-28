<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">MyApp</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                        @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                        @endauth
                        <li class="nav-item"><a class="nav-link" href="{{ route('account') }}">Accounts</a></li> 
                        <li class="nav-item"><a class="nav-link" href="{{ route('settings') }}">Settings</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-4">
        {{$slot}}
    </main>

    <footer class="bg-light text-center py-3 mt-4">
        <p>&copy; {{ date('D, d-M-Y') }}  All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
        //document.addEventListener('DOMContentLoaded', function () {
        //    Livewire.on('show-user-id-modal', (data) => {
        //        console.log("Received User ID:", data.user_id);
        //        document.getElementById('generatedUserId').innerText = data.user_id;

        //        var userIdModal = new bootstrap.Modal(document.getElementById('userIdModal'));
        //        userIdModal.show();
        //    });

        //    document.getElementById('redirectToLogin').addEventListener('click', function () {
        //        window.location.href = "{{ route('home') }}";
        //    });
        //});
    
    </script>
</body>
</html>