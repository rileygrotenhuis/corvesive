<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->boolean('is_automatic')->default(false)->after('due_date');
        });

        Schema::table('pay_period_bill', function (Blueprint $table) {
            $table->boolean('is_automatic')->default(false)->after('has_payed');
        });
    }

    public function down(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->dropColumn('is_automatic');
        });

        Schema::table('pay_period_bill', function (Blueprint $table) {
            $table->dropColumn('is_automatic');
        });
    }
};
