<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserTransaction;
use App\Models\User;

class TransactionController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required|string|exists:users,user_id',
            'amount' => 'required|numeric',
        ]);

        // Save transaction
        UserTransaction::create([
            'transaction_id' => $this->generateTransactionId(),
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'transaction_type' => 'deposit',
        ]);

        return response()->json([
            'message' => 'Transaction saved successfully',
            'transaction_id' => $transactionId // ✅ Return generated ID for reference
        ]);
    }
        private function generateTransactionId()
        {
            $prefix = 'TRNRD';
        $date = date('dmY'); // Format: ddMMyyyy
        // Get the last transaction for today
            // Get the last transaction based on the latest created_at timestamp
        $lastTransaction = UserTransaction::latest('created_at')->first();

        // Extract the last 3 digits, if no transaction exists, start from 001
        $lastNumber = $lastTransaction ? intval(substr($lastTransaction->transaction_id, -3)) : 0;

        
        // Increment and format it to always have 3 digits (001, 002, 003, ...)
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        
        $transactionId = $prefix . $date . $newNumber;

        return $transactionId;

            //. $date 
        }

}
