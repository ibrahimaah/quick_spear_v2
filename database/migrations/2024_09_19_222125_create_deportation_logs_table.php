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
        Schema::create('deportation_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamp('last_deported_report_date')->nullable(); // Store as timestamp
            $table->timestamps();
        });
    
        // Insert a default row
        DB::table('deportation_logs')->insert([
            'last_deported_report_date' => null, // or an initial timestamp value
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
        Schema::dropIfExists('deportation_logs');
    }
};
