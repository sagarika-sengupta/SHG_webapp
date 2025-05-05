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
    public $accountNumber;
    public $notificationCount;


    public function mount()
    {
        $userId = session()->get('user_id');

        if ($userId) {
            $user = User::find($userId);

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

        // Calculate the available balance
        $this->availableBalance = UserTransaction::where('user_id', $this->userId)
            ->where('transaction_type', 'deposit')
            ->sum('amount');
        
         // Fetch the count of notifications for the logged-in user
         $this->notificationCount = UserTransaction::where('user_id', auth()->id())->count();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
