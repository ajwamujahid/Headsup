<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('customers', function (Blueprint $table) {
        $table->unsignedBigInteger('salesperson_id')->nullable()->after('id');

        // optional: if referencing sales_profiles
        $table->foreign('salesperson_id')->references('id')->on('sales_profiles')->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            //
        });
    }
};
