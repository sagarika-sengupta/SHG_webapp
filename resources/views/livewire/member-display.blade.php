<div>
{{-- Back Button --}}
        <div class="mb-3">
            <a href="{{ route('GroupDashboard') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
        </div>
<div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Group Details</h2>
        <p><strong>Group ID:</strong> {{ $group_id }}</p>
        <p><strong>Group Name:</strong> {{ $group_name }}</p>
    </div>

    <hr>

    <div class="text-center mb-4">
        <h3 class="fw-semibold">Group Members</h3>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th scope="col">Sl No.</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Village</th>
                    <th scope="col">State</th>
                    <th scope="col">Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $index => $member)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $member->user_id }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->village }}</td>
                        <td>{{ $member->state }}</td>
                        <td>{{ $member->pivot->role }}</td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


    </div>
    </div>