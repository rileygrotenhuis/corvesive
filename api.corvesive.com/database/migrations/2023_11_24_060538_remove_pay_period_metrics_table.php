<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('pay_period_metrics');
    }

    public function down(): void
    {
        Schema::create('pay_period_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->foreignId('pay_period_id')->constrained('pay_periods', 'id');
            $table->bigInteger('bills_total_payed')->default(0);
            $table->bigInteger('bills_total_unpayed')->default(0);
            $table->bigInteger('bills_total')->default(0);
            $table->bigInteger('budgets_total_balance')->default(0);
            $table->bigInteger('budgets_remaining_balance')->default(0);
            $table->bigInteger('total_paystubs')->default(0);
            $table->bigInteger('total_income')->default(0);
            $table->bigInteger('bills_total_spent')->default(0);
            $table->bigInteger('budgets_total_spent')->default(0);
            $table->bigInteger('total_spent')->default(0);
            $table->bigInteger('total_deposited')->default(0);
            $table->bigInteger('current_surplus')->default(0);
            $table->bigInteger('projected_surplus')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
