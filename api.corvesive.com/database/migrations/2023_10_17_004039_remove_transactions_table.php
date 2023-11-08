<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('transactions');
    }

    public function down(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->string('transactionable_type');
            $table->unsignedBigInteger('transactionable_id');
            $table->enum('type', [
                'payment',
                'deposit',
            ])->default('payment');
            $table->bigInteger('amount');
            $table->timestamps();
        });
    }
};
