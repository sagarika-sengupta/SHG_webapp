<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GroupTable;
use App\Models\UserTransaction;
use App\Models\User;


class GroupTransactions extends Component
{
    public $transactions = [];
    public $group_name;
    public $group_Id;
    public $TotalAmount;

    public function group_transactions()
    {
        // Get the group ID from the session
        $groupId = session('group_id');
        $this->group_Id = $groupId;
        $groupId = session('group_id');
    $group = GroupTable::where('group_id', $groupId)->first();
    if($group)
    {
      //  $query = UserTransaction::with('group')->where('user_id', $userId);

           // UserTransaction::where('group_id', $groupId)->get();
        $this->transactions = UserTransaction::with('user')->where('group_id', $groupId)
            ->get(['user_id', 'transaction_id', 'group_id', 'amount', 'transaction_type', 'created_at']);
          //  ->toArray();
        $this->TotalAmount = UserTransaction::where('group_id', $groupId)
            ->sum('amount');

    }
}
    public function mount()
    {
        $this->group_transactions();

    }
    
    public function render()
    {
        return view('livewire.group-transactions');
    }
}
