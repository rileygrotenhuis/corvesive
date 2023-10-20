<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('spendings');
    }

    public function down(): void
    {
        Schema::create('spendings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->foreignId('pay_period_id')->constrained('pay_periods', 'id');
            $table->unsignedBigInteger('total_balance');
            $table->bigInteger('remaining_balance');
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
