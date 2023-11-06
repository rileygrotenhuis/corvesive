<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pay_period_paystub', function (Blueprint $table) {
            $table->unique(['pay_period_id', 'paystub_id']);
        });

        Schema::table('pay_period_bill', function (Blueprint $table) {
            $table->unique(['pay_period_id', 'bill_id']);
        });

        Schema::table('pay_period_budget', function (Blueprint $table) {
            $table->unique(['pay_period_id', 'budget_id']);
        });
    }

    public function down(): void
    {
        Schema::table('pay_period_paystub', function (Blueprint $table) {
            $table->dropUnique(['pay_period_id', 'paystub_id']);
        });

        Schema::table('pay_period_bill', function (Blueprint $table) {
            $table->dropUnique(['pay_period_id', 'bill_id']);
        });

        Schema::table('pay_period_budget', function (Blueprint $table) {
            $table->dropUnique(['pay_period_id', 'budget_id']);
        });
    }
};
