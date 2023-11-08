<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('credit_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->string('issuer');
            $table->string('name');
            $table->enum('type', [
                'visa',
                'mastercard',
                'amex',
                'other',
            ]);
            $table->unsignedBigInteger('credit_limit');
            $table->decimal('interest_rate', 5, 2);
            $table->unsignedBigInteger('annual_fee')->nullable();
            $table->string('benefits')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('credit_accounts');
    }
};
