<div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">SHG</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        {{-- {For Home button there is no @if clause therefore li is directly rendered} --}}
                        <!-- <li class="nav-item"><a class="nav-link" href="{{ session('user_id') ? route('dashboard') : route('GroupDashboard') }}">Home</a></li> -->
                        {{--{Because for ternary operator nested if-else cannot be used. thus it was written in the way below}--}}
                        <li class="nav-item">
                                    @if(session('user_id'))
                                        <a class="nav-link" href="{{ route('dashboard') }}">Home</a>
                                    @elseif(session('group_id'))
                                        <a class="nav-link" href="{{ route('GroupDashboard') }}">Home</a>
                                    @else
                                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                                    @endif
                        </li>

                        @if(session('user_id'))
                            @if($dashboard)
                            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                            @endif
                        @endif
                        @if(session('group_id'))
                            @if($group_dashboard)
                            <li class="nav-item"><a class="nav-link" href="{{ route('GroupDashboard') }}">GroupDashboard</a></li>
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