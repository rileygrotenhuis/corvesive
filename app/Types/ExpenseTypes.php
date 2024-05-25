<?php

namespace App\Types;

trait ExpenseTypes
{
    /**
     * The different types of expenses
     * that a user can have.
     */
    public static array $EXPENSE_TYPES = [
        'bill',
        'budget',
        'saving',
    ];
}
