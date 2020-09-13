<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->unsignedBigInteger('agent_id');
            $table->string('reference_link'); // link/url
            $table->string('reference_code'); // unique code at the end of url
            $table->string('point')->nullable();
            $table->integer('max_claim')->default(1);
            $table->integer('is_active')->default(1);
            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();
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
