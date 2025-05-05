<div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">MyApp</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                        @if(session('user_id'))
                            @if($dashboard)
                            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                            @endif
                        @endif
                        @if($account)
                        <li class="nav-item"><a class="nav-link" href="{{ route('account') }}">Accounts</a></li> 
                        @endif
                        @if($setting)
                        <li class="nav-item"><a class="nav-link" href="{{ route('settings') }}">Settings</a></li>
                        @endif
                        @if($contacts)
                        <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                        @endif
                        @if($about)
                        <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
</div>