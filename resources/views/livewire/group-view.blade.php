<div>
<div class="container mt-5">
    <h2 class="text-center mb-4">Groups Managed by You</h2>

    {{-- Display Groups --}}
    <div class="row">
        <div class="col-md-8 mx-auto">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Group ID</th>
                        <th>Village</th>
                        <th>District</th>
                        <th>State</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($this->getGroupsofLeader() as $group)
                        <tr>
                            <td>{{ $group->group_id }}</td>
                            <td>{{ $group->village }}</td>
                            <td>{{ $group->district }}</td>
                            <td>{{ $group->state }}</td>
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
               
                <button class="btn btn-secondary w-100" onclick="window.location.href='#'">Manage Group Members</button>
                  </div>
        </div>
    </div>
</div>
</div>
