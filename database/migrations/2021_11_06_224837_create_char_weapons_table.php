<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharWeaponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('char_weapons', function (Blueprint $table) {
            $table->foreignId('char_id')->constrained();
            $table->foreignId('weapon_id')->constrained();
            $table->string('observation')->nullable();
            $table->integer('bba_total')->nullable();
            $table->integer('ammu')->nullable();
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
        Schema::dropIfExists('char_weapons');
    }
}
