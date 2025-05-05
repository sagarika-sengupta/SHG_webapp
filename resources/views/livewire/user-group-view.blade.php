<div>
<div class="container mt-5">
    <h2 class="text-center mb-4">Your Groups</h2>

    {{-- Display Groups --}}
    <div class="row">
        <div class="col-md-8 mx-auto">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Group ID</th>
                        <th>Group Name</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($groups as $group)
                        <tr>
                            <td>{{ $group['group_id'] }}</td>
                            <td>{{ $group['group_name'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No groups found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Manage Group Buttons --}}
    <div class="row mt-4">
        <div class="col-md-4 mx-auto">
            <div class="d-flex flex-column gap-3">
               
                <button class="btn btn-secondary w-100" onclick="window.location.href='#'">Group Information</button>
                  </div>
        </div>
    </div>
</div>
</div>
