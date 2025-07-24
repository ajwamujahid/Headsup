<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_sales', function (Blueprint $table) {
            $table->id(); // bigint unsigned, auto increment
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('interest')->nullable();
            $table->text('notes')->nullable();
            $table->longText('process')->nullable(); // JSON or array serialized data
            $table->string('disposition')->nullable();
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_sales');
    }
};
