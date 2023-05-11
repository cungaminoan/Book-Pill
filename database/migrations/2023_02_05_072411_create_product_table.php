<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('author');
            $table->tinyInteger('delivery');
            $table->bigInteger('price');
            $table->float('discount');
            $table->json('genre');
            $table->tinyInteger('age');
            $table->integer('number_of_product');
            $table->tinyInteger('status_product');
            $table->float('rating');
            $table->integer('sold');
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
        Schema::dropIfExists('product');
    }
}
