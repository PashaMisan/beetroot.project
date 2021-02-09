<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 200);
            $table->bigInteger('section_id')->unsigned();
            $table->integer('position');
            $table->string('description', 500);
            $table->string('text', 2000);
            $table->integer('weight');
            $table->integer('price');
            $table->string('image')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();
        });

        Schema::table('products', function ($table) {
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
