<div class="container mt-4">
    <h2 class="text-center">Transaction History</h2>

    <!-- Filter Dropdown + Button -->
    <div class="d-flex justify-content-center mb-3">
        <select class="form-select w-50 me-2" wire:model="groupFilter">
            <option value="">All Groups</option>
            @foreach ($availableGroups as $group)
                <option value="{{ $group['group_id'] }}">{{ $group['group_name'] }}</option>
            @endforeach
        </select>
            <!-- Status Filter -->
    <select class="form-select w-25" wire:model="statusFilter">
        <option value="">All Statuses</option>
        <option value="approved">Approved</option>
        <option value="pending">Pending</option>
        <option value="rejected">Rejected</option>
    </select>
        <button class="btn btn-primary" wire:click="filterByGroup">Filter</button>
    </div>

    <!-- Transactions Table -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>SN</th>
                <th>Transaction ID</th>
                <th>Group ID</th>
                <th>Group Name</th>
                <th>Amount (₹)</th>
                <th>Type</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaction->transaction_id }}</td>
                    <td>{{ $transaction->group_id }}</td>
                    <td>{{ $transaction->group->group_name ?? 'N/A' }}</td>
                    <td>{{ number_format($transaction->amount, 2) }}</td>
                    <td>{{ ucfirst($transaction->transaction_type) }}</td>
                    <td>{{ $transaction->created_at->format('d M Y, h:i A') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No transactions found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
