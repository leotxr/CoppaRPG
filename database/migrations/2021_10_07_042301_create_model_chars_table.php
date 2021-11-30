<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelCharsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('char', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->integer('breed_id')->unsigned();
            $table->integer('class_id')->unsigned();
            $table->integer('weapon_id')->unsigned();
            $table->integer('armor_id')->unsigned();
            $table->integer('level');
            $table->string('trend')->nullable();
            $table->string('religion')->nullable();
            $table->integer('age')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('height')->nullable();
            $table->integer('str')->nullable();
            $table->integer('dex')->nullable();
            $table->integer('con')->nullable();
            $table->integer('int')->nullable();
            $table->integer('wiz')->nullable();
            $table->integer('cha')->nullable();
            $table->integer('modstr')->nullable();
            $table->integer('moddex')->nullable();
            $table->integer('modcon')->nullable();
            $table->integer('modint')->nullable();
            $table->integer('modwiz')->nullable();
            $table->integer('modcha')->nullable();
            $table->integer('pv')->nullable();
            $table->integer('ca')->nullable();
            $table->integer('initiative')->nullable();
            $table->integer('bba')->nullable();
            $table->integer('for')->nullable();
            $table->integer('basefor')->nullable();
            $table->integer('habfor')->nullable();
            $table->integer('magicfor')->nullable();
            $table->integer('otherfor')->nullable();
            $table->integer('ref')->nullable();
            $table->integer('baseref')->nullable();
            $table->integer('habref')->nullable();
            $table->integer('magicref')->nullable();
            $table->integer('otherref')->nullable();
            $table->integer('will')->nullable();
            $table->integer('basewill')->nullable();
            $table->integer('habwill')->nullable();
            $table->integer('magicwill')->nullable();
            $table->integer('otherwill')->nullable();
            $table->integer('natural_armor')->nullable();
            $table->integer('touch_ca')->nullable();
            $table->integer('surprise_ca')->nullable();
            $table->integer('xp')->nullable();
            $table->string('bag')->nullable();   
            

            $table->foreign('user_id')->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->foreign('armor_id')->references('id')
            ->on('armor')
            ->onUpdate('cascade');
            
            $table->foreign('weapon_id')->references('id')
            ->on('weapon')
            ->onUpdate('cascade');
        
            $table->foreign('breed_id')->references('id')
            ->on('breed')
            ->onUpdate('cascade');

            $table->foreign('class_id')->references('id')
            ->on('classe')
            ->onUpdate('cascade');
                        
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
        Schema::dropIfExists('char');
    }
}
