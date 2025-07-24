<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('email')->nullable()->after('name');
            $table->string('interest')->nullable();
            $table->text('notes')->nullable();
            $table->json('process')->nullable();
            $table->string('disposition')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['email', 'interest', 'notes', 'process', 'disposition']);
        });
    }
    

   
};
