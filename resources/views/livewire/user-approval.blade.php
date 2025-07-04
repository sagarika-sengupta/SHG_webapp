<div class="container mt-4">
    <h4 class="fw-bold text-primary">USER APPROVALS</h4>

    @if (session()->has('message'))
        <div class="alert alert-success mt-2">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered mt-3 text-center">
        <thead class="table-primary">
            <tr>
                <th>User ID</th>
                <th>Group ID</th>
                <th>Group Name</th>
                <th>Date</th>
                <th>Approval </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pendingRequests as $req)
                <tr>
                    <td>{{ $req->user_id }}</td>
                    <td>{{ $req->group_id }}</td>
                    <td>{{ $req->group_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($req->created_at)->format('d-m-Y H:i') }}</td>
                    <td>
                        <button wire:click="approve('{{ $req->user_id }}', '{{ $req->group_id }}')" class="btn btn-success btn-sm">
                             Approve
                        </button> 
                        <button wire:click="reject('{{ $req->user_id }}', '{{ $req->group_id }}')" class="btn btn-success btn-sm">
                            Reject
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No requests found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
