<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeaponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weapons', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('name')->nullable();
            $table->string('desc')->nullable();
            $table->string('damage')->nullable();
            $table->integer('total_bba')->nullable();
            $table->string('decisive')->nullable();
            $table->string('reach')->nullable();
            $table->string('size')->nullable();
            $table->double('weight')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('weapons');
    }
}
