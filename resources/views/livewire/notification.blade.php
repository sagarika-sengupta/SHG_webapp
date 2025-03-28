<!-- filepath: c:\Users\lenovo\OneDrive\Documents\prac001\resources\views\livewire\notification.blade.php -->
<div>
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h2 class="text-center mb-4">Notifications</h2>
            @if (count($notifications) > 0)
                <ul class="list-group">
                    @foreach ($notifications as $notification)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $notification['message'] }}</span>
                            <small class="text-muted">{{ $notification['timestamp'] }}</small>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-center text-muted">No notifications available.</p>
            @endif
        </div>
    </div>
</div>