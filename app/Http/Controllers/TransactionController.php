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
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'transaction_type' => 'deposit',
        ]);

        return response()->json(['message' => 'Transaction saved successfully']);
    }
}
