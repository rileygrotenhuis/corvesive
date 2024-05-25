<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payday_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('monthly_paystub_id')->constrained('monthly_paystubs')->cascadeOnDelete();
            $table->foreignId('monthly_expense_id')->constrained('monthly_expenses')->cascadeOnDelete();
            $table->unsignedBigInteger('amount_in_cents');
            $table->boolean('is_completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payday_tasks');
    }
};
