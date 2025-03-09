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

    public function mount()
    {
        $user = Auth::User();
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
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
