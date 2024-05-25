<?php

namespace App\Events\Expenses;

use App\Models\Expense;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExpenseModified
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Expense $expense)
    {
        //
    }
}
