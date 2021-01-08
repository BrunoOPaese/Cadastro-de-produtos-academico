<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_interests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->string('name', 255);
            $table->string('email', 255);
            $table->text('message');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onupdate('cascade')->ondelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_interests', function (Blueprint $table) {
            $table->dropForeign('product_interests_product_id_foreign');
        });
        Schema::dropIfExists('product_interests');
    }
}
