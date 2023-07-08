<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saving_pay_period', function (Blueprint $table) {
            $table->id();
            $table->foreignId('saving_id')->constrained('savings', 'id');
            $table->foreignId('pay_period_id')->constrained('pay_periods', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saving_pay_period');
    }
};
