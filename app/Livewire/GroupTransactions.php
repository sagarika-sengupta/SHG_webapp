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
    public $groupFilter;
    public $statusFilter;
    public $status;

    public function mount()
    {
        $this->group_transactions();
    }

    public function group_transactions()
    {
        // Get the group ID from the session
        $groupId = session('group_id');
        $this->group_Id = $groupId;
        
       $this->loadTransactions($groupId); // Load all by default


    $group = GroupTable::where('group_id', $groupId)->first();
    if($group)
    {
      //  $query = UserTransaction::with('group')->where('user_id', $userId);

           // UserTransaction::where('group_id', $groupId)->get();
        $this->transactions = UserTransaction::with('user')->where('group_id', $groupId)->where('status','approved')
            ->get(['user_id', 'transaction_id', 'group_id', 'amount', 'transaction_type', 'created_at']);
          //  ->toArray();
        $this->TotalAmount = UserTransaction::where('group_id', $groupId)
            ->where('status','approved')
            ->sum('amount');

    }}
    public function filterByGroup()
    {
        $this->loadTransactions(session('group_id'));
    }

    public function loadTransactions($groupId)
    {
        $query = UserTransaction::with('group')->where('group_id', $groupId);

    
        if (!empty($this->statusFilter)) {
            $query->where('status', $this->statusFilter);
        }

        $this->transactions = $query->get([
           'user_id', 'transaction_id', 'group_id', 'amount', 'transaction_type', 'created_at', 'status'
        ]);
    }


    
    public function render()
    {
        return view('livewire.group-transactions')->layout('components.layouts.app', ['theme' => 'theme-group']);
    }
}
