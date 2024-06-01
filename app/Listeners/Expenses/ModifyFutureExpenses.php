<?php

namespace App\Listeners\Expenses;

use App\Events\Expenses\ExpenseModified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ModifyFutureExpenses
{
    use InteractsWithQueue, SerializesModels;

    public function handle(ExpenseModified $event): void
    {
        $expense = $event->expense;

        $expense->modifyFutureExpenses($expense);
    }
}
