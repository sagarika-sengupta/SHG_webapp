<div class="container mt-4">
    <!-- Notification Button -->
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary rounded-0" onclick="window.location.href='{{ route('notification') }}'">
            Notifications <span class="badge bg-danger">{{ $notificationCount }}</span>
        </button>
    </div>

    <!-- Top Button Navigation -->
    <div class="border border-primary bg-light p-3 mb-4">
        <div class="d-flex justify-content-between gap-3">
            <button onclick="window.location.href='{{ route('contribution') }}'" class="btn btn-primary p-3 flex-fill rounded-0">Deposit</button>
            <button onclick="window.location.href='{{ route('loan') }}'" class="btn btn-primary p-3 flex-fill rounded-0">Loan</button>
            <button onclick="window.location.href='{{ route('user-group-view') }}'" class="btn btn-primary p-3 flex-fill rounded-0">View Group Details</button>
            <button class="btn btn-primary p-3 flex-fill rounded-0">Enquiry</button>
        </div>
    </div>

    <!-- Welcome Message -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h3 class="fw-bold text-primary">Hello, "{{ session('user_name') }}"</h3>
        </div>
    </div>

    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-4">
            <div class="border border-primary bg-light p-3 h-100">
                <div class="d-flex flex-column gap-3">
                    <button class="btn btn-primary p-3 rounded-0">Account Details</button>
                    <button class="btn btn-primary p-3 rounded-0">View</button>
                    <x-group-bar />
                    <form id="Logout" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary p-3 rounded-0">Logout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Section -->
        <div class="col-md-9">
            <!-- Account Summary -->
            <div class="border border-primary bg-light p-3 mb-4">
                <h4 class="fw-bold text-primary">Account Summary</h4>
                <table class="table table-bordered mt-3">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>Account No.</th>
                            <th>Branch</th>
                            <th>Available Balance</th>
                            <th>Transaction History</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <td>{{ $accountNumber }}</td>
                            <td>{{ $branch }}</td>
                            <td>
                                <ul class="list-unstyled mb-0">
                                    @foreach($groupBalances as $group)
                                        <li><strong>{{ $group['group_name'] }}:</strong> ₹{{ number_format($group['amount'], 2) }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td><a href="{{ route('transaction-history') }}">Click here</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Your Groups -->
            <div class="border border-primary bg-light p-3">
                <h4 class="fw-bold text-primary">Your Groups</h4>
                <x-groups-viewof-user />
            </div>
        </div>
    </div>
</div>
