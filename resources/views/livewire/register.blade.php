<div>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
            <h2 class="text-center mb-4">Register</h2>
            <form wire:submit.prevent="register">
                <div class="mb-3">
                    <input type="text" class="form-control" wire:model="name" placeholder="Name" required>
                    @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-3">
                    <input type="text" class="form-control" wire:model="phone" placeholder="Phone Number" required>
                    @error('phone') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-3">
                    <input type="text" class="form-control" wire:model="village" placeholder="Village" required>
                    @error('village') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-3">
                    <input type="text" class="form-control" wire:model="district" placeholder="District" required>
                    @error('district') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-3">
                    <input type="text" class="form-control" wire:model="state" placeholder="State" required>
                    @error('state') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-3">
    <select class="form-control" wire:model="monthly_contribution" required>
        <option value="" disabled selected>Select Monthly Contribution</option>
        <option value="200">200</option>
        <option value="500">500</option>
        <option value="1000">1000</option>
    </select>
    @error('monthly_contribution') <div class="text-danger small">{{ $message }}</div> @enderror
</div>
                
                <div class="mb-3">
                    <input type="text" class="form-control" wire:model="group_id" placeholder="Group ID (if given)">
                    @error('group_id') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-3">
                    <input type="text" class="form-control" wire:model="user_id" placeholder="User ID" required>
                    @error('user_id') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-3">
                    <input type="password" class="form-control" wire:model="password" placeholder="Password" required>
                    @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-3">
                    <input type="password" class="form-control" wire:model="password_confirmation" placeholder="Confirm Password" required>
                    @error('password_confirmation') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                
                <button type="submit" class="btn btn-success w-100">Register</button>
            </form>
        </div>
    </div>
    
    <!-- Bootstrap CSS (Include this if not already included in your project) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</div>