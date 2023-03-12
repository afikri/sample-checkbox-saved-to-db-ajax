<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transactions.index');
    }

    public function store(Request $request)
    {
        $transaction = new Transaction;
        $transaction->paid = $request->input('paid', '0');
        $transaction->expired = $request->input('expired', '0');

        if ($transaction->expired || $transaction->paid) {
            $transaction->is_flagged = 1;
        } else {
            $transaction->is_flagged = 0;
        }

        // Save the transaction to the database
        $transaction->save();

        return redirect()->route('transactions.index');
    }

    public function updateFlagged(Request $request)
    {
        $expired = $request->input('expired', '0');
        $paid = $request->input('paid', '0');

        $is_flagged = $expired || $paid ? 1 : 0;

        return response()->json(['is_flagged' => $is_flagged]);
    }


    // public function updateStatus(Request $request, Transaction $transaction)
    // {
    //     $transaction->isFlagged = $request->isFlagged;
    //     $transaction->save();
    //     return response()->json(['success' => true]);
    // }
}
