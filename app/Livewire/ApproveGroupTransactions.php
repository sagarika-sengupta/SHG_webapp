<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UserTransaction;
use Illuminate\Support\Facades\Session;

class ApproveGroupTransactions extends Component
{
    public $pendingTransactions = [];

    public function mount()
    {
        $this->loadPending();
    }

    public function loadPending()
    {
        $groupId = session('group_id');

        if (!$groupId) {
            session()->flash('message', 'No group selected.');
            $this->pendingTransactions = [];
            return;
        }

        $this->pendingTransactions = UserTransaction::where('group_id', $groupId)
            ->where('status', 'pending')
            ->orderByDesc('created_at')
            ->get();
    }

   // private function generateTransactionId($userId, $groupId)
    private function generateTransactionId($userId, $groupId)
        {
            $prefix = 'TRNRD';
            $userGroupId = strtoupper($userId) . '_' . strtoupper($groupId) . '_';
            $date = date('dmY');

            do {
                $random = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
                $transactionId = $prefix . $userGroupId . $date . $random;
            } while (UserTransaction::where('transaction_id', $transactionId)->exists());

            return $transactionId;
        }


    public function approve($paymentId)
    {
        $txn = UserTransaction::where('payment_id', $paymentId)->first();

        if ($txn && $txn->status === 'pending') {
            $txn->transaction_id = $this->generateTransactionId($txn->user_id, $txn->group_id);
            $txn->status = 'approved';
            $txn->save();
            session()->flash('message', 'Transaction approved.');
        }

        $this->loadPending();
    }

    public function reject($paymentId)
    {
        $txn = UserTransaction::where('payment_id', $paymentId)->first();

        if ($txn && $txn->status === 'pending') {
            $txn->status = 'rejected';
            $txn->save();
            session()->flash('message', 'Transaction rejected.');
        }

        $this->loadPending();
    }

    public function render()
    {
        return view('livewire.approve-group-transactions', [
            'transactions' => $this->pendingTransactions ?? collect()
        ]);
    }
}
