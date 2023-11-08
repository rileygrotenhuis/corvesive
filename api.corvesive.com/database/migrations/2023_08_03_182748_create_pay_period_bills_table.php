<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pay_period_bill', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pay_period_id')->constrained('pay_periods', 'id');
            $table->foreignId('bill_id')->constrained('bills', 'id');
            $table->unsignedBigInteger('amount');
            $table->date('due_date');
            $table->boolean('has_payed')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pay_period_bill');
    }
};
