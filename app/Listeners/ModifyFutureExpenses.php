<?php

namespace App\Listeners;

use App\Events\ExpenseModified;
use App\Models\MonthlyExpense;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ModifyFutureExpenses implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public function handle(ExpenseModified $event): void
    {
        $expense = $event->expense;

        $today = now()->format('Y-m-d');

        MonthlyExpense::query()
            ->where('expense_id', $expense->id)
            ->where('due_date', '>=', $today)
            ->update([
                'amount_in_cents' => $expense->amount_in_cents,
            ]);
    }
}
