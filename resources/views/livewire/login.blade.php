<div>
    @if(session()->has('user_logged_in') && session('user_logged_in') === true)
        <div class="card text-center p-4">
            <p class="h4">Welcome, {{ session('user_name') }}!</p>

            <!-- KYC Form Modal Trigger -->
            @if (!session('is_kyc_completed'))  {{-- You can store this in session too --}}
                <livewire:kyc />
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger mt-3">Logout</button>
            </form>
        </div>
    @else
                <div class="card p-4">
                    <h2 class="text-center mb-4">User Login</h2>
                    <form wire:submit.prevent="login">
                        @csrf 
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
            @endif