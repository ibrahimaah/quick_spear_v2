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
        Schema::create('last_deportation_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamp('last_deporation_time')->nullable();
            $table->unsignedBigInteger('current_deportation_group_id');
            $table->timestamps();
        });

        DB::table('last_deportation_logs')->insert([
            'id'         => 1, 
            'current_deportation_group_id' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('last_deportation_logs');
    }
};
