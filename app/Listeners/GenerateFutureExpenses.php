<?php

namespace App\Listeners;

use App\Events\ExpenseCreated;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateFutureExpenses implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(ExpenseCreated $event): void
    {
        $expense = $event->expense;

        for ($i = 0; $i < 12; $i++) {
            $dueDate = Carbon::now()->addMonths($i)->day($expense->due_day_of_month);

            $expense->schedule(
                $expense,
                $dueDate->year,
                $dueDate->month,
                $dueDate,
                $expense->amount_in_cents
            );
        }
    }
}
