<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UserTransaction;
use App\Models\User;

class TransactionHistory extends Component
{
    public $transactions = [];
    public $availableGroups = [];
    public $groupFilter = '';
    public $statusFilter = '';

    public function mount()
    {
        $userId = session('user_id');
        $user = User::with('groups')->where('user_id', $userId)->first();
        $this->availableGroups = $user?->groups ?? [];

        $this->loadTransactions($userId); // Load all by default
    }

    public function filterByGroup()
    {
        $this->loadTransactions(session('user_id'));
        
    }

    public function loadTransactions($userId)
    {
        $query = UserTransaction::with('group')->where('user_id', $userId);
        //  HARD CODING IS NOT REQUIRED HERE. NOT REQUIRED TO SELECT TRANSACTIONS BASED ON THEIR 'status'.
        // fILTER IS DONE BELOW VIA -> IF(...){$query->where('status', $this->statusFilter);}
        // ->where('status','approved');
        // $query_rejected = UserTransaction::with('group')->where('user_id', $userId)->where('status','rejected');
        // $query_pending = UserTransaction::with('group')->where('user_id', $userId)->where('status','pending');

        if (!empty($this->groupFilter)) {
            //groupFilter is the name of the select input in the blade file
            // If a group is selected, filter transactions by that group
            $query->where('group_id', $this->groupFilter);
        }
        if (!empty($this->statusFilter)) {
        $query->where('status', $this->statusFilter);
        }

        $this->transactions = $query->get([
            'transaction_id', 'group_id', 'amount', 'transaction_type', 'created_at'
        ]);
    }

    public function render()
    {
        return view('livewire.transaction-history');
    }
}

/*class TransactionHistory extends Component
{
    public $transactions = []; // Array to hold transaction data. called in the blade file as @forelse($transactions as $transaction)
    
    public function mount()
    {
        $userId = session('user_id'); 
        if(!$userId) {
            return; // Return nothing
        }
        // Get the authenticated user ID
        
        //dd($userId); //"Dump and Die". It is a debugging tool provided by Laravel to inspect the value of a variable and stop the execution of the script.
        $this->transactions=UserTransaction::with('group')->where('user_id', $userId)->get(['transaction_id','group_id', 'amount', 'transaction_type', 'created_at']);

        }
    public function render()
    {
        return view('livewire.transaction-history');
    }
} */