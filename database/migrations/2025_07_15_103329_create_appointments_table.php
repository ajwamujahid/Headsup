<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('phone');
            $table->date('date');
            $table->time('time');
            $table->string('status')->default('scheduled')->change();
            $table->unsignedBigInteger('salesperson_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('salesperson_id')->references('id')->on('sales_profiles')->onDelete('set null');
        });
    }

    public function down(): void {
        Schema::dropIfExists('appointments');
    }
};
