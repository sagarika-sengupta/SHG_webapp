<div>
<!-- Group Login Card -->
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

                        <button type="submit" class="btn btn-danger w-100">Login</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="#" class="text-decoration-none">Forgot Password?</a> | 
                        <a href="{{ route('group-registration') }}" class="text-decoration-none">Register</a>
                    </div>
                </div>
            </div>
        </div>

</div>
</div>

</div>
