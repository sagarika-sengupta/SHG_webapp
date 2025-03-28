<!-- filepath: c:\Users\lenovo\OneDrive\Documents\prac001\resources\views\livewire\group-registration.blade.php -->
<div>
    <div class="container mt-5">
        <div class="card p-4">
            <h2 class="text-center mb-4">Group Registration</h2>
            <form wire:submit.prevent="register">
                <!-- Group ID -->
                <div class="mb-3">
                    <label for="group_id" class="form-label">Group ID:</label>
                    <input type="text" id="group_id" class="form-control" wire:model="group_id" required>
                    @error('group_id') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

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

                <!-- State -->
                <div class="mb-3">
                    <label for="state" class="form-label">State:</label>
                    <input type="text" id="state" class="form-control" wire:model="state" required>
                    @error('state') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <!-- Members -->
                <div class="mb-3">
                    <label class="form-label">Members:</label>
                    @foreach ($members as $index => $member)
                        <div class="d-flex align-items-center mb-2">
                            <input type="text" class="form-control me-2" wire:model="members.{{ $index }}" placeholder="Member Id" required>
                            <button type="button" class="btn btn-danger btn-sm" wire:click="removeMember({{ $index }})">Remove</button>
                        </div>
                        @error('members.' . $index) <div class="text-danger small">{{ $message }}</div> @enderror
                    @endforeach
                    <button type="button" class="btn btn-success btn-sm mt-2" wire:click="addMember">Add Member</button>
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

            <!-- Success Message -->
            @if (session()->has('message'))
                <div class="alert alert-success mt-3">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>
</div>