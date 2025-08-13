<div>
    <div class="container mt-4">
    <div class="card p-4">
        <h2 class="mb-4 text-center">Group Settings</h2>
        <!-- Flash Messages -->
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        
        <h4 class="mb-3">Change Maximum Members Allowed for a Group</h4>
        <!-- form  for changing max members here -->
        <form wire:submit.prevent="updateMaxMembers" class="d-flex align-items-center mb-4">
                <input type="number" wire:model="max_members" class="form-control me-2" min="1" placeholder="Enter new max members" required>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        <hr>

     
        <!--  form  for changing RD amount here -->
          <h4 class="mb-3">Change Monthly Contribution Amount</h4>
            <form wire:submit.prevent="updateMonthlyContributionAmount" class="d-flex align-items-center">
                <input type="number" wire:model="monthly_contribution" class="form-control me-2" min="1" step="0.01" placeholder="Enter new RD amount" required>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
</div>
