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

        Schema::create('bill_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); 
        });

        DB::table('bill_statuses')->insert(
            [
                ['id' => 1, 'name' => 'Under Review'], 
                ['id' => 2, 'name' => 'Payment Made'], 
                ['id' => 3, 'name' => 'Canceled'] 
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
        Schema::dropIfExists('bill_statuses');
    }
};
