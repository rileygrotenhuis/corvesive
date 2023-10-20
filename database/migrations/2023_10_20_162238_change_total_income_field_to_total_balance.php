<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pay_periods', function (Blueprint $table) {
            $table->renameColumn('total_income', 'total_balance');
        });
    }

    public function down(): void
    {
        Schema::table('total_balance', function (Blueprint $table) {
            $table->renameColumn('total_balance', 'total_income');
        });
    }
};
