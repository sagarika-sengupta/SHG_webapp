
<div class="container mt-5">
    <div class="card p-4">
        <h2 class="text-center mb-4">Group Registration</h2>

        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <!-- Display User ID After Registration -->
        @if (session()->has('group_id'))
            <div class="alert alert-success mt-3">
                <strong>Your Group ID: </strong> {{ session('group_id') }}
            </div>
        @endif

        <!-- Error Message -->
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="group_register">
            <!-- Group Name -->
            <div class="mb-3">
                <label for="group_name" class="form-label">Group Name:</label>
                <input type="text" id="group_name" class="form-control" wire:model="group_name" required>
                @error('group_name') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <!-- Village -->
            <div class="mb-3">
                <label for="village" class="form-label">Village:</label>
                <input type="text" id="village" class="form-control" wire:model="village" required>
                @error('village') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <!-- District -->
            <div class="mb-3">
                <label for="district" class="form-label">District:</label>
                <input type="text" id="district" class="form-control" wire:model="district" required>
                @error('district') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <!-- User ID -->
            <div class="mb-3">
                <label for="user_id" class="form-label">User ID:</label>
                <input type="text" id="user_id" class="form-control" wire:model="user_id" required>
                @error('user_id') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <!-- State -->
            <div class="mb-3">
                <label for="state" class="form-label">State:</label>
                <input type="text" id="state" class="form-control" wire:model="state" required>
                @error('state') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>
            <!-- Monthly Contribution -->
            <div class="mb-3">
                <label for="monthly_contribution" class="form-label">Monthly Contribution:</label>
                <input type="number" id="monthly_contribution" class="form-control" wire:model="monthly_contribution" step="0.01" required>
            </div>

            <!-- Group Password -->
            <div class="mb-3">
                <label for="group_password" class="form-label">Group Password:</label>
                <input type="password" id="group_password" class="form-control" wire:model="group_password" required>
                @error('group_password') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <!-- Confirm Group Password -->
            <div class="mb-3">
                <label for="group_password_confirmation" class="form-label">Confirm Group Password:</label>
                <input type="password" id="group_password_confirmation" class="form-control" wire:model="group_password_confirmation" required>
                @error('group_password_confirmation') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">Register Group</button>
        </form>
    </div>
</div>
