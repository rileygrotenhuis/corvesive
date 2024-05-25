<?php

namespace App\Listeners\Expenses;

use App\Events\Expenses\ExpenseModified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ModifyFutureExpenses implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public function handle(ExpenseModified $event): void
    {
        $expense = $event->expense;

        $expense->modifyFutureExpenses($expense);
    }
}
