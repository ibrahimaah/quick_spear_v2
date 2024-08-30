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
        Schema::create('bills', function (Blueprint $table) 
        {
            $table->id();
            $table->string('bill_number');
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('delegate_id');
            $table->string('consignee_name')->nullable();
            $table->string('consignee_phone');
            
            $table->unsignedBigInteger('consignee_city');
            $table->unsignedBigInteger('consignee_region');
             
            $table->decimal('order_price', 8, 2);
            $table->decimal('value_on_delivery', 8, 3)->default(0.000);

            $table->text('customer_notes')->nullable();
            $table->text('delegate_notes')->nullable();

            $table->boolean('is_returned')->default(0); 
            $table->unsignedBigInteger('shipment_status_id');
            $table->unsignedBigInteger('bill_status_id');
            $table->timestamps();  
            
            $table->foreign('consignee_city')->references('id')->on('cities');
            $table->foreign('consignee_region')->references('id')->on('regions');
            $table->foreign('delegate_id')->references('id')->on('delegates');
            $table->foreign('shop_id')->references('id')->on('shops');
            $table->foreign('shipment_status_id')->references('id')->on('shipment_statuses');
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
        Schema::dropIfExists('bills');
    }
};
