<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pay_periods', function (Blueprint $table) {
            $table->dropColumn('total_balance');
        });
    }

    public function down(): void
    {
        Schema::table('pay_periods', function (Blueprint $table) {
            $table->bigInteger('total_balance')
                ->default(0)
                ->after('end_date');
        });
    }
};
