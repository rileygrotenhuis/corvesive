<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pay_period_budget', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pay_period_id')->constrained('pay_periods', 'id');
            $table->foreignId('budget_id')->constrained('budgets', 'id');
            $table->unsignedBigInteger('total_balance');
            $table->bigInteger('remaining_balance');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pay_period_budget');
    }
};
