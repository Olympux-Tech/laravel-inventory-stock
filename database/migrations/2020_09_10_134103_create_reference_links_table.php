<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenceLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reference_links', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('agent_id');
            $table->string('reference_code');
            $table->string('reference_url');
            $table->string('point')->default(null)->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('is_active')->default(1);
            $table->date('start_at');
            $table->date('end_at');
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
        Schema::dropIfExists('reference_links');
    }
}
