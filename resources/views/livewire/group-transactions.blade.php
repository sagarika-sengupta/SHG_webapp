<div>
{{-- Back Button --}}
        <div class="mb-3">
            <a href="{{ route('GroupDashboard') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
        </div>
        <div>
                    <!-- Status Filter -->
    <select class="form-select w-25" wire:model="statusFilter">
        <option value="">All Statuses</option>
        <option value="approved">Approved</option>
        <option value="pending">Pending</option>
        <option value="rejected">Rejected</option>
    </select>
        <button class="btn btn-primary" wire:click="filterByGroup">Filter</button>
    </div>
    <table class="table table-bordered table-striped">
        <thead class="table-primary text-white">
            <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>Transaction ID</th>
                <th>Group ID</th>
                <th>Amount</th>
                <th>Transaction Type</th>
                <th>Created At</th>
                <th> Status </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->user_id }}</td>
                    <td>{{ $transaction->user->name ?? 'N/A' }}</td>
                    <td>{{ $transaction->transaction_id }}</td>
                    <td>{{ $transaction->group_id }}</td>
                    <td>{{ $transaction->amount }}</td>
                    <td>{{ $transaction->transaction_type }}</td>
                    <td>{{ $transaction->created_at }}</td>
                    <td>{{ $transaction->status}} </td>
                </tr>
            @endforeach
            @if ($statusFilter === '' || $statusFilter === 'approved')
                <tr>
                    <td colspan="4" class="text-end fw-bold">Total Amount</td>
                    <td class="fw-bold">{{ $TotalAmount }}</td>
                    <td colspan="2"></td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
