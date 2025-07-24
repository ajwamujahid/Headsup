<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_checkins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('salesperson_id');
            $table->timestamp('check_in_time')->nullable();
            $table->timestamp('check_out_time')->nullable();
            $table->integer('duration')->default(0); // in seconds
            $table->timestamps();
        
            $table->foreign('salesperson_id')->references('id')->on('sales_profiles')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_checkins');
    }
};
