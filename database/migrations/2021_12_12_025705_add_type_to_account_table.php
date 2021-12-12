<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->string("email")->unique()->change();
            $table->integer("type")->default(1);
            $table->string("aws_id")->nullable()->change();
            $table->string("arn")->nullable()->change();
            $table->string("status")->nullable()->change();
            $table->string("joined_method")->nullable()->change();
            $table->dateTime("joined_at")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            //
        });
    }
}
