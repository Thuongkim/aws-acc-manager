<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string("aws_id");
            $table->string("arn");
            $table->string("email");
            $table->string("name");
            $table->string("status");
            $table->string("joined_method");
            $table->timestamp("joined_at");
            $table->string("aws_access_key_id")->nullable();
            $table->string("aws_secret_access_key")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
