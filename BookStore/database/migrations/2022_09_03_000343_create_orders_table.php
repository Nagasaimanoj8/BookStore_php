<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('address_id');
            $table->unsignedInteger('cart_id');
            $table->string('book_name');
            $table->string('book_author');
            $table->integer('book_price');
            $table->integer('book_quantity');
            $table->decimal('total_price');
            $table->string('order_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('cart_id')
                ->references('id')
                ->on('cart')
                ->onDelete('cascade')
                ->onUpdate('cascade');   
            $table->foreign('address_id')
                ->references('id')
                ->on('addresses')
                ->onDelete('cascade')
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
        Schema::dropIfExists('orders');
    }
};
