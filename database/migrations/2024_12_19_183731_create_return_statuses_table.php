<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('return_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

        DB::table('return_statuses')->insert(
            [
                ['id' => 1, 'name' => 'NOT_RECEIVED_FROM_DELEGATE'], 
                ['id' => 2, 'name' => 'RECEIVED_FROM_DELEGATE'],
                ['id' => 3, 'name' => 'DELIVERED_TO_THE_SHOP'], 
                ['id' => 4, 'name' => 'DELETED'],
                ['id' => 5, 'name' => 'UNDER_REVIEW']
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('return_statuses');
    }
};
