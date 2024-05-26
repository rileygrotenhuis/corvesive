<?php

namespace App\Listeners\Expenses;

use App\Events\Expenses\ExpenseRescheduled;

class RescheduleFutureExpenses
{
    public function handle(ExpenseRescheduled $event): void
    {
        $expense = $event->expense;

        $expense->rescheduleFutureExpenses($expense);
    }
}
