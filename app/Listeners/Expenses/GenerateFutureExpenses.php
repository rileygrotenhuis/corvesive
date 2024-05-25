<?php

namespace App\Listeners\Expenses;

use App\Events\Expenses\ExpenseCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateFutureExpenses implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(ExpenseCreated $event): void
    {
        $expense = $event->expense;

        $expense->generateFutureExpenses($expense);
    }
}
