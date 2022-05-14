<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharMagicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('char_magics', function (Blueprint $table) {
            $table->foreignId('char_id')->constrained();
            $table->foreignId('magic_id')->constrained();
            $table->integer('slots')->nullable();
            $table->integer('qpd')->nullable();
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
        Schema::dropIfExists('char_magics');
    }
}
