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
        Schema::create('bills_tracking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->string('bill_number')->unique();
            $table->timestamp('bill_date');
            $table->unsignedBigInteger('bill_status_id');
            $table->unsignedBigInteger('deportation_group_id');
            $table->timestamps();


            $table->foreign('shop_id')->references('id')->on('shops');
            $table->foreign('bill_status_id')->references('id')->on('bill_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills_tracking');
    }
};
