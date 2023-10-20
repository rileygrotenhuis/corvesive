<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RemoveNegativeValuesForTransactions extends Command
{
    protected $signature = 'transactions:remove-negative-values';

    protected $description = 'Removes all negative values in transactions table for newer architeture';

    public function handle(): void
    {
        DB::table('transactions')->update(['amount' => DB::raw('ABS(amount)')]);
    }
}
