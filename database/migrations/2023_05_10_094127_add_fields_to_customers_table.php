<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToCustomersTable extends Migration
{
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->date('birthday')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('bank_data_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('birthday');
            $table->dropColumn('address');
            $table->dropColumn('bank_data_id');
        });
    }
}
