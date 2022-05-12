<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magics', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('name')->nullable();
            $table->string('desc')->nullable();
            $table->string('class_name')->nullable();
            $table->string('type')->nullable();
            $table->string('level')->nullable();
            $table->string('component')->nullable();
            $table->string('reach')->nullable();
            $table->double('duration')->nullable();
            $table->string('target')->nullable();
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
        Schema::dropIfExists('magics');
    }
}
