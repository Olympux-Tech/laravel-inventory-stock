<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->text('alamat')->default(null)->nullable();
            $table->string('email')->default(null)->nullable();
            $table->string('telepon')->default(null)->nullable();
            $table->string('status')->default(1)->nullable(); //closed-deal=9/otw=5/open=1
            $table->string('remarks')->default(null)->nullable();
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
        Schema::dropIfExists('customers');
    }
}
