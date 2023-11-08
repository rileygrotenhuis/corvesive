<?php

namespace App\Services;

use App\Models\Budget;

class BudgetService
{
    public function createBudget(
        int $userId,
        string $name,
        int $amount,
        ?string $notes
    ): Budget {
        $budget = new Budget();
        $budget->user_id = $userId;
        $budget->name = $name;
        $budget->amount = $amount;
        $budget->notes = $notes;
        $budget->save();

        return $budget;
    }

    public function updateBudget(
        Budget $budget,
        string $name,
        int $amount,
        ?string $notes
    ): Budget {
        $budget->name = $name;
        $budget->amount = $amount;
        $budget->notes = $notes;
        $budget->save();

        return $budget;
    }

    public function deleteBudget(Budget $budget): bool
    {
        return $budget->delete();
    }
}
