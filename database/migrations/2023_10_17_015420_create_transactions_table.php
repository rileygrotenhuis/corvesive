<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->foreignId('pay_period_id')->constrained('pay_periods', 'id');
            $table->foreignId('pay_period_bill_id')->nullable()->constrained('pay_period_bill', 'id');
            $table->foreignId('pay_period_budget_id')->nullable()->constrained('pay_period_budget', 'id');
            $table->enum('type', [
                'payment',
                'deposit',
            ]);
            $table->bigInteger('amount');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
