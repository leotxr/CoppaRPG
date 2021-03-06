<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chars', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->integer('breed_id')->unsigned();
            $table->integer('class_id')->unsigned();
            $table->integer('armor_id')->unsigned();
            $table->integer('shield_id')->unsigned();
            $table->integer('level');
            $table->string('trend')->nullable();
            $table->string('religion')->nullable();
            $table->integer('age')->nullable();
            $table->string('sex')->nullable();
            $table->string('eyes')->nullable();
            $table->string('hair')->nullable();
            $table->string('size')->nullable();
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
            $table->integer('grab')->nullable();
            $table->integer('pv')->nullable();
            $table->integer('actpv')->nullable();
            $table->string('dv')->nullable();
            $table->integer('ca')->nullable();
            $table->integer('modarmor')->nullable();
            $table->integer('desloc')->nullable();
            $table->integer('modshield')->nullable();
            $table->integer('modotherca')->nullable();
            $table->integer('initiative')->nullable();
            $table->integer('modsize')->nullable();
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
            $table->double('gp')->nullable();
            $table->double('sp')->nullable();
            $table->double('cp')->nullable();
            $table->string('observations')->nullable();
          

            

            $table->foreign('user_id')->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->foreign('armor_id')->references('id')
            ->on('armors')
            ->onUpdate('cascade');
        
            $table->foreign('breed_id')->references('id')
            ->on('breeds')
            ->onUpdate('cascade');

            $table->foreign('class_id')->references('id')
            ->on('classes')
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
        Schema::dropIfExists('chars');
    }
}
