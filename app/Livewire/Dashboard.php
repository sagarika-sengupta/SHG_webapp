<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\UserTransaction;
use App\Models\User;
//use Livewire\Component;

class Dashboard extends Component
{
    public $availableBalance;
    public $userId;
    public $branch;
    public $Groups = [];
    public $accountNumber;
    public $notificationCount;
    public $groupBalances = [];


    public function mount()
    {
        
        $userId = session()->get('user_id');

        if ($userId) {
            $user = User::find($userId);
            $this->Groups = $user?->groups ?? [];
            if ($user) {
            $this->branch = $user->village; // Assuming 'village' is the branch
            $this->accountNumber = $user->user_id;
            $this->userId = $user->user_id;

            // Manually set other session values if needed
            session()->put('user_logged_in', true);
            session()->put('user_name', $user->name);
            session()->put('is_kyc_completed', $user->is_kyc_completed);
            }
        }
        //$user = Auth::users(); // ✅ Get the authenticated user

        if ($user) {
            $this->branch = $user->village; // ✅ Assuming 'village' is the branch
            $this->accountNumber = $user->user_id;
            $this->userId = $user->user_id; }
        //$branch = $users->village;
        //$accountNumber = $users->user_id;
        //$this->userId = $users->user_id;

        // Group-wise available balance
        foreach ($this->Groups as $group) {
            $amount = UserTransaction::where('user_id', $user->user_id)
                ->where('group_id', $group->group_id)
                ->where('transaction_id', 'not like', 'pending_%') // Exclude all pending_ transactions // Exclude pending
                ->sum('amount');

            $this->groupBalances[] = [
                'group_name' => $group->group_name,
                'amount' => $amount
            ];
        
         // Fetch the count of notifications for the logged-in user
         $this->notificationCount = UserTransaction::where('user_id', auth()->id())->count();
    }
}

    public function render()
    {
        return view('livewire.dashboard');
    }
}
