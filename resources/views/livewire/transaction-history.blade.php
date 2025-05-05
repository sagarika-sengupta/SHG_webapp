<div class="container mt-4">
    <h2 class="text-center">Transaction History</h2>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>SN</th>
                <th>Transaction ID</th>
                <th>Amount (₹)</th>
                <th>Type</th>
                <th>Status</th>
                <!-- <th>Date</th> -->
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $transaction)
                <tr>
                <td>{{ $loop->iteration }}</td> <!-- Serial Number -->
                <td>{{ $transaction->transaction_id }}</td>
                    <td>{{ number_format($transaction->amount, 2) }}</td>
                    <td>{{ ucfirst($transaction->transaction_type) }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaction->created_at->format('d M Y, h:i A')) }}</td>
                    <!-- <td> {{ $transaction->status }}</td> -->
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No transactions found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
