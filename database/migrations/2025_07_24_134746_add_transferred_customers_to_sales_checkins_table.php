<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sales_checkins', function (Blueprint $table) {
            $table->integer('transferred_customers')->default(0)->after('pending_customers_count');
        });
    }

    public function down()
    {
        Schema::table('sales_checkins', function (Blueprint $table) {
            $table->dropColumn('transferred_customers');
        });
    }
};
