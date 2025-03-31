<div>
    <div class="container mt-5">
    @auth
        <div class="card text-center p-4">
            <p class="h4">Welcome, {{ Auth::user()->name }}!</p>

                            <!-- KYC Form Modal Trigger -->
                @if (!Auth::user()->is_kyc_completed)
                    <livewire:kyc />
                @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger mt-3">Logout</button>
            </form>
        </div>
    @else
    <div class="row justify-content-center">
            <!-- User Login Card -->
            <div class="col-md-5">
                <div class="card p-4">
                    <h2 class="text-center mb-4">User Login</h2>
                    <form wire:submit.prevent="login">
                        <div class="mb-3">
                            <label for="user_id" class="form-label">User ID:</label>
                            <input type="text" id="user_id" class="form-control" wire:model="user_id" required>
                            @error('user_id') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" id="password" class="form-control" wire:model="password" required>
                            @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="#" class="text-decoration-none">Forgot Password?</a> | 
                        <a href="{{ route('register') }}" class="text-decoration-none">Register</a>
                    </div>
                </div>
            </div>

            <!-- Group Login Card -->
            <div class="col-md-5">
                <div class="card p-4">
                    <h2 class="text-center mb-4">Group Login</h2>
                    <form wire:submit.prevent="groupLogin">
                        <div class="mb-3">
                            <label for="group_id" class="form-label">Group ID:</label>
                            <input type="text" id="group_id" class="form-control" wire:model="group_id" required>
                            @error('group_id') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="group_password" class="form-label">Password:</label>
                            <input type="password" id="group_password" class="form-control" wire:model="group_password" required>
                            @error('group_password') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-success w-100">Login</button>
                    </form>
                    <div class="text-center mt-3">
                    <a href="#" class="text-decoration-none">Forgot Password?</a> | 
                    <a href="{{ route('group-registration') }}" class="text-decoration-none">Register</a>
                </div>
                </div>
            </div>
        </div>
    
    @endauth
</div>
</div>
<!-- used for creating only user login with centre alignment
        <div class="card p-4 mx-auto" style="max-width: 400px;">
            <h2 class="text-center mb-4">Login</h2>
            <form wire:submit.prevent="login"> ....
     -->