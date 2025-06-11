<div>
{{-- Display Groups --}}
    <div class="row">
        <div class="col-md-8 mx-auto">
            <table class="table table-bordered table-striped">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Group ID</th>
                        <th>Group Name</th>
                        <th>Role </th>
                    </tr>
                </thead>
                <tbody class ="text-center">
                    @forelse($groups as $group)
                        <tr>
                            <td>{{ $group['group_id'] }}</td>
                            <td>{{ $group['group_name'] }}</td>
                            <td>{{$group['role']}} </td>
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
</div>