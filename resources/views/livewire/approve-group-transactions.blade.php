<div class="container mt-4">
    <h4 class="fw-bold text-primary">Approve Group Transactions</h4>

    @if (session()->has('message'))
        <div class="alert alert-success mt-2">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered mt-3 text-center">
        <thead class="table-primary">
            <tr>
                <th>Payment ID</th>
                <th>User ID</th>
                <th>Group ID</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $txn)
                <tr>
                    <td>{{ $txn->payment_id }}</td>
                    <td>{{ $txn->user_id }}</td>
                    <td>{{ $txn->group_id }}</td>
                    <td>{{ ucfirst($txn->transaction_type) }}</td>
                    <td>{{ $txn->amount }}</td>
                    <td>{{ \Carbon\Carbon::parse($txn->created_at)->format('d-m-Y H:i') }}</td>
                    <td>
                        <button wire:click="approve('{{ $txn->payment_id }}')" class="btn btn-success btn-sm">Approve</button>
                        <button wire:click="reject('{{ $txn->payment_id }}')" class="btn btn-danger btn-sm ms-2">Reject</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No transactions found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
