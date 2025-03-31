<div class="d-flex justify-content-center align-items-center vh-100"> <!-- Single Root Element -->
    <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
        <h2 class="text-center mb-4">Register</h2>

        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <!-- Display User ID After Registration -->
        @if (session()->has('user_id'))
            <div class="alert alert-success mt-3">
                <strong>Your User ID: </strong> {{ session('user_id') }}
            </div>
        @endif

        <form wire:submit.prevent="register">
            <div>
            <div class="mb-3">
                <input type="text" class="form-control w-100" wire:model="name" placeholder="Name" required>
                @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <input type="text" class="form-control w-100" wire:model="phone" placeholder="Phone Number" required>
                @error('phone') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <input type="text" class="form-control w-100" wire:model="village" placeholder="Village" required>
                @error('village') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <input type="text" class="form-control w-100" wire:model="district" placeholder="District" required>
                @error('district') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <input type="text" class="form-control w-100" wire:model="state" placeholder="State" required>
                @error('state') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <input type="text" class="form-control w-100" wire:model="group_id" placeholder="Group ID (if given)">
                @error('group_id') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <!-- Password Fields -->
            <div class="mb-3">
                <input type="password" class="form-control w-100" wire:model="password" placeholder="Password" required>
                @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <input type="password" class="form-control w-100" wire:model="password_confirmation" placeholder="Confirm Password" required>
                @error('password_confirmation') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <!-- Register Button -->
            <button type="submit" class="btn btn-success w-100">Register</button>
            </div>
        </form>
    </div>

    <!-- Modal 
    <div class="modal fade" id="userIdModal" tabindex="-1" aria-labelledby="userIdModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userIdModalLabel">Registration Successful</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Your User ID is: <strong id="generatedUserId"></strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="redirectToLogin">OK</button>
                </div>
            </div>
        </div>
    </div> -->
</div> <!-- END SINGLE ROOT WRAPPER -->
         <!--   <div class="mb-3"> 
                <select class="form-control w-100" wire:model="monthly_contribution" required>
                    <option value="" disabled selected>Select Monthly Contribution</option>
                    <option value="200">200</option>
                    <option value="500">500</option>
                    <option value="1000">1000</option>
                </select>
                @error('monthly_contribution') <div class="text-danger small">{{ $message }}</div> @enderror
            </div> -->
