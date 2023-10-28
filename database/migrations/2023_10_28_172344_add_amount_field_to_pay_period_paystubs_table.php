<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pay_period_paystub', function (Blueprint $table) {
            $table->unsignedBigInteger('amount')->after('paystub_id')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('pay_period_paystub', function (Blueprint $table) {
            $table->dropColumn('amount');
        });
    }
};
