<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pay_period_bill', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('pay_period_budget', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('pay_period_paystub', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('pay_period_bill', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('pay_period_budget', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('pay_period_paystubc', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
};
