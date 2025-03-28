<!--LOGIN FORM WITH TWO CONTAINERS(ONE FOR USER LOGIN, AND THE OTHER FOR GROUP LOGIN)-->
<!-- filepath: c:\Users\lenovo\OneDrive\Documents\prac001\resources\views\livewire\login.blade.php -->
<div>
    <!-- Toggle Buttons -->
    <div class="d-flex justify-content-center mb-4">
        <button class="btn btn-primary mx-2" wire:click="$set('isGroupLogin', false)">User Login</button>
        <button class="btn btn-secondary mx-2" wire:click="$set('isGroupLogin', true)">Group Login</button>
    </div>

    <!-- User Login Container -->
    @if (!$isGroupLogin)
        <div class="container border p-4">
            <h3 class="text-center">User Login</h3>
            <form wire:submit.prevent="loginUser">
                <div class="mb-3">
                    <label for="user_id" class="form-label">User ID:</label>
                    <input type="text" id="user_id" class="form-control" wire:model="user_id">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" class="form-control" wire:model="password">
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    @endif

    <!-- Group Login Container -->
    @if ($isGroupLogin)
        <div class="container border p-4">
            <h3 class="text-center">Group Login</h3>
            <form wire:submit.prevent="loginGroup">
                <div class="mb-3">
                    <label for="group_id" class="form-label">Group ID:</label>
                    <input type="text" id="group_id" class="form-control" wire:model="group_id">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" class="form-control" wire:model="password">
                </div>
                <button type="submit" class="btn btn-secondary w-100">Login</button>
            </form>
        </div>
    @endif
</div>


<!-- LOGIN FORM USING USER_ID (only user login) 
<div>
    <form wire:submit.prevent="login">
        <div>
            <label for="user_id">User ID:</label>
            <input type="text" id="user_id" wire:model="user_id">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" wire:model="password">
        </div>
        <button type="submit">Login</button>
    </form>
</div> -->
<!-- LOGIN FORM USING EMAIL(DEFAULT OF LARAVEL)
<div>
    <form wire:submit.prevent="login">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" wire:model="email">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" wire:model="password">
        </div>
        <button type="submit">Login</button>
    </form>
</div> -->
