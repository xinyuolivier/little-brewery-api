<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('brewery_id');
            $table->string('description');
            $table->string('flavor');
            $table->string('color');
            $table->string('packaging');
            $table->string('image')->default(null);
            $table->double('price');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('brewery_id')->references('id')->on('breweries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('beers');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        
    }
}
