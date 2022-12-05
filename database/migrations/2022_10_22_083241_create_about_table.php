<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about', function (Blueprint $table) {
            $table->id();
            $table->string('heading1');
            $table->string('heading2');
            $table->string('para1');
            $table->string('para2');
            $table->string('heading3');
            $table->string('para3');
            $table->string('heading4');
            $table->string('heading5');
            $table->string('para4');
            $table->string('heading6');
            $table->string('para5');
            $table->string('heading7');
            $table->string('para6');
            $table->string('heading8');
            $table->string('heading9');
            $table->string('para7');
            $table->string('heading10');
            $table->string('para8');
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
        Schema::dropIfExists('about');
    }
};
