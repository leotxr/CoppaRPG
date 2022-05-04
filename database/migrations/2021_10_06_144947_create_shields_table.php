<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shields', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('name')->nullable();
            $table->string('desc')->nullable();
            $table->string('type')->nullable();
            $table->integer('ca_bonus')->nullable();
            $table->integer('penal_dex')->nullable();
            $table->integer('max_bonus')->nullable();
            $table->integer('desloc')->nullable();
            $table->double('weight')->nullable();
            $table->double('value')->nullable();
            $table->string('special')->nullable();
            $table->string('arcane_fail')->nullable();
            $table->string('arcane_magic')->nullable();
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
        Schema::dropIfExists('shields');
    }
}
