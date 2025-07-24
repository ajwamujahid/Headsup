<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('customers', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('phone')->nullable();
        $table->text('note')->nullable();
        $table->unsignedBigInteger('assigned_to'); // salesperson_id
        $table->boolean('transferred')->default(false);
        $table->unsignedBigInteger('transferred_to')->nullable();
        $table->timestamps();
    });
}


    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
