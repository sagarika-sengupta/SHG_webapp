<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body.theme-user {
            --bs-primary: #0d6efd;
            background-color: #f8f9fa;
        }

        body.theme-group {
            --bs-primary: #b23b52;
            background-color: #fdf2f3;
        }

        .btn-primary {
            background-color: var(--bs-primary) !important;
            border-color: var(--bs-primary) !important;
        }

        a, .text-primary {
            color: var(--bs-primary) !important;
        }

        header, footer {
            background-color: var(--bs-primary);
            color: white;
        }
    </style>
</head>
<body class="{{ $theme ?? 'theme-user' }}">
    <header>
        <x-test-net-var-cmp dashboard=1 contact=1 accounts=1 />
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