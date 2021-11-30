<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArmorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('armor', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('name')->nullable();
            $table->string('desc')->nullable();
            $table->string('type')->nullable();
            $table->integer('ca_bonus')->nullable();
            $table->integer('max_dex')->nullable();
            $table->integer('penal')->nullable();
            $table->integer('desloc')->nullable();
            $table->double('weight')->nullable();
            $table->double('value')->nullable();
            $table->string('special')->nullable();
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
        Schema::dropIfExists('armors');
    }
}
