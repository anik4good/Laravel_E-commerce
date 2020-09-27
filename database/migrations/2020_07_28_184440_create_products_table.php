<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('product_tittle');
            $table->string('product_slug')->unique();
            $table->string('product_code')->unique();
            $table->float('product_price')->default(0);
            $table->string('product_image')->default('default.png');
            $table->string('gallary_image_1')->default('default.png');
            $table->string('gallary_image_2')->default('default.png');
            $table->string('gallary_image_3')->default('default.png');
            $table->text('short_description');
            $table->text('long_description');
            $table->integer('product_stock')->default(0);
            $table->integer('product_view_count')->default(0);
            $table->boolean('product_status')->default(false);
            $table->boolean('product_is_approved')->default(false);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
