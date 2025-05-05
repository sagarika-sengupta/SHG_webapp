<div>

    <!-- Horizontal Bar (Top Navigation) -->
    <div class="border border-primary bg-light p-3">
        <div class="d-flex justify-content-between gap-3">
        <!--<a href="{{ route('contribution') }}" class="btn btn-primary p-3 flex-fill rounded-0">
    Monthly Contribution
</a>-->

            <!-- <button onclick="window.location.href='{{ route('contribution') }}'" class="btn btn-primary p-3 flex-fill rounded-0">Monthly Contribution</button> -->
            <button onclick="window.location.href='{{ route('member-display') }}'"class="btn btn-primary p-3 flex-fill rounded-0">Members</button>
            <button onclick="window.location.href='{{ route('member-display') }}'"class="btn btn-primary p-3 flex-fill rounded-0">Group Transactions</button>
            <button class="btn btn-primary p-3 flex-fill rounded-0">Group Balance</button>
        </div>
    </div>

    <!-- Move Vertical Sidebar Below -->
    <div class="row mt-4">
        <!-- Centered Hello Username Text -->
        <div class="col-12 text-center">
            <h3 class="fw-bold text-primary">Hello, "{{ session('group_name') }}"</h3>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Vertical Sidebar (Shifted Below Horizontal Bar) -->
        <div class="col-md-3">
            <div class="border border-primary bg-light p-3">
                <div class="d-flex flex-column gap-3">
                    <button onclick="window.location.href='{{ route('group-member') }}'" class="btn btn-primary p-3 rounded-0">Add/Delete Members</button>
                    <button onclick="window.location.href='{{ route('group-registration') }}'" class="btn btn-primary p-3 rounded-0">Group Registration</button>
                    <!-- <button class="btn btn-primary p-3 rounded-0">View</button> -->

                    <!-- Logout Button with Correct Styling -->
                    <form id="group_logout" method="POST" action="{{ route('group_logout') }}">
                         @csrf 
                         <!-- If you removed @csrf by mistake, Laravel will block the request and show a 419 page.
                          crsf(cross site request forgery) When you have a POST form (like your logout form), Laravel needs to verify that the request came from your actual app, not from an external malicious site. -->
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
                            <th>Group_ID</th>
                            <th>Total Members</th>
                            <th>Member Details</th>
                            <!-- <th>Transaction History</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$group_id}}</td>
                            <td>{{$members_count}}</td>
                            <td><a href="{{ route('member-display') }}">Click here</a></td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>