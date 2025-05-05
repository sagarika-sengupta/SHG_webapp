<div>
<div class="container mt-4">
{{-- Back Button --}}
        <div class="mb-3">
            <a href="{{ route('GroupDashboard') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
        </div>
@if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session()->has('error1'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        {{ session('error1') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <h4 class="fw-bold text-primary">Manage Group Members</h4>
    <form class="row g-3" wire:submit.prevent>
         <!-- @csrf 
         <input type="hidden" name="group_id" value="{{ session('group_id') }}">  -->

        <div class="col-md-6">
            <label for="user_id" class="form-label">User ID</label>
            <input type="text" wire:model="user_id" class="form-control" pattern="[A-Za-z0-9]+" title="User ID must be alphanumeric" required>
        </div>

        <div class="col-md-6 d-flex align-items-end gap-2">
            <button type="button" wire:click="addMember" class="btn btn-success w-50">Add</button>
            <button type="button" wire:click="removeMember" class="btn btn-danger w-50">Delete</button>

        </div>
        
</div>
</div>
