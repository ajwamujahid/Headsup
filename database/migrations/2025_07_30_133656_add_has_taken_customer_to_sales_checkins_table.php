<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sales_checkins', function (Blueprint $table) {
            $table->boolean('has_taken_customer')->default(false);
        });
    }
    
    public function down()
    {
        Schema::table('sales_checkins', function (Blueprint $table) {
            $table->dropColumn('has_taken_customer');
        });
    }
    
};
