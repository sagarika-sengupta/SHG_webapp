{{-- resources/views/components/group-bar.blade.php --}}

@php $user = \App\Models\User::find(session('user_id')); @endphp
{{-- if we simply use session('user_id'), the role==1 will not work --}}
{{-- because session('user_id') is a string, not an object --}}

{{-- Check if the user is logged in and has a role of 1 --}}
@if ($user && $user->role == 1)
    <div class="d-flex flex-column gap-3">
                <button class="btn p-3 rounded-0" style="background-color: light-grey; color: black; border: 1px solid blue;" onclick="window.location.href='{{ route('group-view') }}'">Group Dashboard</button>
    </div>
@endif
