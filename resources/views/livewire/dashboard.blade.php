<div>
    <div class="container mt-4">
        <!-- Notification Button -->
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-primary rounded-0" onclick="window.location.href='{{ route('notification') }}'">
                Notifications <span class="badge bg-danger"> {{ $notificationCount }} <!--specify a dynamic value for notification-->
                </span>
            </button>
        </div>
    <!-- Horizontal Bar (Top Navigation) -->
    <div class="border border-primary bg-light p-3">
        <div class="d-flex justify-content-between gap-3">
        <!--<a href="{{ route('contribution') }}" class="btn btn-primary p-3 flex-fill rounded-0">
    Monthly Contribution
</a>-->

            <!-- <button onclick="window.location.href='{{ route('contribution') }}'" class="btn btn-primary p-3 flex-fill rounded-0">Monthly Contribution</button> -->
            <button onclick="window.location.href='{{ route('deposit') }}'"class="btn btn-primary p-3 flex-fill rounded-0">Deposit</button>
            <button onclick="window.location.href='{{ route('loan') }}'"class="btn btn-primary p-3 flex-fill rounded-0">Loan</button>
            <button onclick="window.location.href='{{ route('user-group-view') }}'"class="btn btn-primary p-3 flex-fill rounded-0">View Group Details</button>
            <button class="btn btn-primary p-3 flex-fill rounded-0">Enquiry</button>
        </div>
    </div>

    <!-- Move Vertical Sidebar Below -->
    <div class="row mt-4">
        <!-- Centered Hello Username Text -->
        <div class="col-12 text-center">
            <h3 class="fw-bold text-primary">Hello, "{{ session('user_name') }}"</h3>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Vertical Sidebar (Shifted Below Horizontal Bar) -->
        <div class="col-md-3">
            <div class="border border-primary bg-light p-3">
                <div class="d-flex flex-column gap-3">
                    <button class="btn btn-primary p-3 rounded-0">Account Details</button>
                    <button class="btn btn-primary p-3 rounded-0">View</button>
                    <x-group-bar/>
                    <!-- Logout Button with Correct Styling -->
                    <form id="Logout" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary p-3 rounded-0">Logout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Account Summary Table -->
        <div class="col-md-9">
            <div class="border border-primary bg-light p-3">
                <h4 class="fw-bold text-primary">Account Summary</h4>
                <table class="table table-bordered mt-3">
                    <thead class="table-primary">
                        <tr>
                            <th>Account No.</th>
                            <th>Branch</th>
                            <th>Available Balance</th>
                            <th>Transaction History</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$accountNumber}}</td>
                            <td>{{$branch}}</td>
                            <td>{{$availableBalance}}</td>
                            <td><a href="{{ route('transaction-history') }}">Click here</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>
</div>
