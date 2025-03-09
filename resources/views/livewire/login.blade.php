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
</div>
<!--<div>
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
